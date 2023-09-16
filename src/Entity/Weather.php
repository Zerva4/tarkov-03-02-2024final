<?php

declare(strict_types=1);

namespace App\Entity;

use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\WeatherRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;

#[ORM\Entity(repositoryClass: WeatherRepository::class)]
class Weather implements UuidPrimaryKeyInterface, TimestampableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $timestamp;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $cloud;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $windSpeed;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $windDirection;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $windGustiness;

    #[ORM\Column(type: 'boolean')]
    private bool $rain;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $rainIntensivity;

    #[ORM\Column(type: 'float', nullable: false)]
    private float $fog;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $temp;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0])]
    private int $pressure;

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getCloud(): float
    {
        return $this->cloud;
    }

    public function setCloud(float $cloud): self
    {
        $this->cloud = $cloud;

        return $this;
    }

    public function getWindSpeed(): int
    {
        return $this->windSpeed;
    }

    public function setWindSpeed(int $windSpeed): self
    {
        $this->windSpeed = $windSpeed;

        return $this;
    }

    public function getWindDirection(): int
    {
        return $this->windDirection;
    }

    public function setWindDirection(int $windDirection): self
    {
        $this->windDirection = $windDirection;

        return $this;
    }

    public function getWindGustiness(): float
    {
        return $this->windGustiness;
    }

    public function setWindGustiness(float $windGustiness): self
    {
        $this->windGustiness = $windGustiness;

        return $this;
    }

    public function isRain(): bool
    {
        return $this->rain;
    }

    public function setRain(bool $rain): self
    {
        $this->rain = $rain;

        return $this;
    }

    public function getRainIntensivity(): int
    {
        return $this->rainIntensivity;
    }

    public function setRainIntensivity(int $rainIntensivity): self
    {
        $this->rainIntensivity = $rainIntensivity;

        return $this;
    }

    public function getFog(): float
    {
        return $this->fog;
    }

    public function setFog(float $fog): self
    {
        $this->fog = $fog;

        return $this;
    }

    public function getTemp(): int
    {
        return $this->temp;
    }

    public function setTemp(int $temp): self
    {
        $this->temp = $temp;

        return $this;
    }

    public function getPressure(): int
    {
        return $this->pressure;
    }

    public function setPressure(int $pressure): self
    {
        $this->pressure = $pressure;

        return $this;
    }
}
