<?php

declare(strict_types=1);

namespace App\DTO;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class WeatherResponseDTO
 */
class WeatherResponseDTO
{
    /**
     * @Serializer\Type("string")
     */
    private string $name;

    /**
     * @Serializer\Type("array<string, App\DTO\WeatherDTO>")
     */
    private array $weather;

    /**
     * @Serializer\Type("App\DTO\MainDTO")
     */
    private MainDTO $main;

    /**
     * WeatherResponseDTO constructor.
     *
     * @param string  $name
     * @param array   $weather
     * @param MainDTO $main
     */
    public function __construct(string $name, array $weather, MainDTO $main)
    {
        $this->name = $name;
        $this->weather = $weather;
        $this->main = $main;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array|WeatherDTO[]
     */
    public function getWeather(): array
    {
        return $this->weather;
    }

    /**
     * @return MainDTO
     */
    public function getMain(): MainDTO
    {
        return $this->main;
    }

    /**
     * @return string
     */
    public function weatherToString(): string
    {
        return implode(
            ', ',
            array_map(fn(WeatherDTO $weatherDTO) => ($weatherDTO->getDescription()), $this->getWeather())
        );
    }
}