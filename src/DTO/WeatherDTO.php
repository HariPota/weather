<?php

declare(strict_types=1);

namespace App\DTO;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class WeatherDTO
 */
class WeatherDTO
{
    /**
     * @Serializer\Type("string")
     */
    private string $description;

    /**
     * WeatherDTO constructor.
     *
     * @param string $description
     */
    public function __construct(string $description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }
}