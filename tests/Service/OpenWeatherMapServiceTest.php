<?php

declare(strict_types=1);

namespace App\Tests\Service;


use App\Service\OpenWeatherMapService;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class OpenWeatherMapServiceTest extends TestCase
{
    private OpenWeatherMapService $openWeatherMapService;
    private MockHandler $mock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->openWeatherMapService = new OpenWeatherMapService('12345678');

        $this->mock = new MockHandler([]);

        $handlerStack = HandlerStack::create($this->mock);
        $client = new Client(['handler' => $handlerStack]);

        $reflectionClass = new \ReflectionClass($this->openWeatherMapService);

        $reflectionProperty = $reflectionClass->getProperty('client');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->openWeatherMapService, $client);
    }

    public function testGetCurrentWeatherSuccessful(): void
    {
        $jsonResponse = file_get_contents(__DIR__.'/../json/response.json');

        $this->mock->reset();
        $this->mock->append(new Response(200, ['X-Foo' => 'Bar'], $jsonResponse));

        $weatherResponseDTO = $this->openWeatherMapService->getCurrentWeather('warsaw');

        $this->assertNotNull($weatherResponseDTO);
        $this->assertStringContainsString($weatherResponseDTO->weatherToString(), 'broken clouds');
        $this->assertStringContainsString($weatherResponseDTO->getName(), 'Warsaw');
        $this->assertStringContainsString((string) $weatherResponseDTO->getMain(), '6.3');
        $this->assertIsFloat($weatherResponseDTO->getMain()->getTemp());
        $this->assertIsArray($weatherResponseDTO->getWeather());
    }

    public function testGetCurrentWeatherFailed(): void
    {
        $this->mock->reset();
        $this->mock->append(new RequestException('Error Communicating with Server', new Request('GET', 'test')));

        $weatherResponseDTO = $this->openWeatherMapService->getCurrentWeather('any');

        $this->assertNull($weatherResponseDTO);
    }
}