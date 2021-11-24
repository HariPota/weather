<?php

declare(strict_types=1);

namespace App\DTO;


use JMS\Serializer\Annotation as Serializer;

/**
 * Class MainDTO
 */
class MainDTO
{
    /**
     * @Serializer\Type("double")
     */
    private float $temp;

    /**
     * MainDTO constructor.
     *
     * @param float $temp
     */
    public function __construct(float $temp)
    {
        $this->temp = $temp;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)round($this->temp, 1);
    }

    /**
     * @return float
     */
    public function getTemp(): float
    {
        return $this->temp;
    }
}