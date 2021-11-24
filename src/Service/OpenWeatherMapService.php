<?php

declare(strict_types=1);

namespace App\Service;


use App\DTO\WeatherResponseDTO;
use App\Service\Helper\LoggerHelper;
use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Monolog\Logger;

/**
 * Class OpenWeatherMapService
 */
class OpenWeatherMapService
{
    private const API_BASE_URL = 'http://api.openweathermap.org';

    private string $apiKey;
    private Client $client;
    private SerializerInterface $serializer;
    private Logger $logger;

    /**
     * OpenWeatherMapService constructor.
     *
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(
            [
                'base_uri' => self::API_BASE_URL,
            ]
        );
        $this->serializer = SerializerBuilder::create()->build();
        $this->logger = (new LoggerHelper())->getLogger();
    }


    /**
     * @param string $city
     *
     * @return WeatherResponseDTO|null
     */
    public function getCurrentWeather(string $city): ?WeatherResponseDTO
    {
        try {
            $response = $this->client->get("/data/2.5/weather?q={$city}&appid={$this->apiKey}&units=metric");

            return $this->serializer->deserialize(
                $response->getBody()->getContents(),
                WeatherResponseDTO::class,
                'json'
            );
        } catch (\Throwable $exception) {
            $this->logger->critical($exception->getMessage(), ['exception' => $exception]);

            return null;
        }
    }
}