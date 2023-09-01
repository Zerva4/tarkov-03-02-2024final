<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ItemPropertiesAmmoInterface;
use App\Interfaces\Item\ItemPropertiesInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ItemPropertiesAmmoRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_ammo', options: ['comment' => 'Таблица свойств для патронов'])]
#[ORM\Entity(repositoryClass: ItemPropertiesAmmoRepository::class)]
class ItemPropertiesAmmo extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesAmmoInterface
{
    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Калибр'])]
    private string $caliber;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Максимально кол-во в ячейке(стеке)'])]
    private int $stackMaxSize;

    #[ORM\Column(type: 'boolean', nullable: false, options: ['default' => false, 'comment' => 'Флаг трассируещего патрона'])]
    private bool $tracer;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Цвет трассирующего патрона'])]
    private string $tracerColor;

    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Тип патрона (пуля, картечь)'])]
    private string $ammoType;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Кол-во пуль (1 пуля, 8 картечи и тд)'])]
    private int $projectileCount;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Наносимый урон'])]
    private int $damage;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Наносимый урон по броне'])]
    private int $armorDamage;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шанс фрагментации в процентах'])]
    private float $fragmentationChance;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шанс рикошета в процентах'])]
    private float $ricochetChance;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шанс пробития в процентах'])]
    private float $penetrationChance;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Бронепробитие'])]
    private int $penetrationPower;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Точность в процентах'])]
    private float $accuracyModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Отдача в процентах'])]
    private float $recoilModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Скорость патрона'])]
    private float $initialSpeed;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шанс вызова слабого кровотечения в процентах'])]
    private float $lightBleedModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Шанс вызова сильного кровотечения в процентах'])]
    private float $heavyBleedModifier;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Износ в процентах'])]
    private float $durabilityBurnFactor;
    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Коэффициент нагрева в процентах'])]
    private float $heatFactor;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Выносливость за выстрел'])]
    private float $staminaBurnPerDamage;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Баллистический коэффициент'])]
    private float $ballisticCoefficient;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Диаметр пули в миллиметрах'])]
    private float $bulletDiameterMillimeters;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Масса пули в граммах'])]
    private float $bulletMassGrams;

    public function getCaliber(): string
    {
        return $this->caliber;
    }

    public function setCaliber(string $caliber): ItemPropertiesAmmoInterface
    {
        $this->caliber = $caliber;

        return $this;
    }

    public function getStackMaxSize(): int
    {
        return $this->stackMaxSize;
    }

    public function setStackMaxSize(int $stackMaxSize): ItemPropertiesAmmoInterface
    {
        $this->stackMaxSize = $stackMaxSize;

        return $this;
    }

    public function isTracer(): bool
    {
        return $this->tracer;
    }

    public function setTracer(bool $tracer): ItemPropertiesAmmoInterface
    {
        $this->tracer = $tracer;

        return $this;
    }

    public function getTracerColor(): string
    {
        return $this->tracerColor;
    }

    public function setTracerColor(string $tracerColor): ItemPropertiesAmmoInterface
    {
        $this->tracerColor = $tracerColor;

        return $this;
    }

    public function getAmmoType(): string
    {
        return $this->ammoType;
    }

    public function setAmmoType(string $ammoType): ItemPropertiesAmmoInterface
    {
        $this->ammoType = $ammoType;

        return $this;
    }

    public function getProjectileCount(): int
    {
        return $this->projectileCount;
    }

    public function setProjectileCount(int $projectileCount): ItemPropertiesAmmoInterface
    {
        $this->projectileCount = $projectileCount;

        return $this;
    }

    public function getDamage(): int
    {
        return $this->damage;
    }

    public function setDamage(int $damage): ItemPropertiesAmmoInterface
    {
        $this->damage = $damage;

        return $this;
    }

    public function getArmorDamage(): int
    {
        return $this->armorDamage;
    }

    public function setArmorDamage(int $armorDamage): ItemPropertiesAmmoInterface
    {
        $this->armorDamage = $armorDamage;

        return $this;
    }

    public function getFragmentationChance(): float
    {
        return $this->fragmentationChance;
    }

    public function setFragmentationChance(float $fragmentationChance): ItemPropertiesAmmoInterface
    {
        $this->fragmentationChance = $fragmentationChance;

        return $this;
    }

    public function getRicochetChance(): float
    {
        return $this->ricochetChance;
    }

    public function setRicochetChance(float $ricochetChance): ItemPropertiesAmmoInterface
    {
        $this->ricochetChance = $ricochetChance;

        return $this;
    }

    public function getPenetrationChance(): float
    {
        return $this->penetrationChance;
    }

    public function setPenetrationChance(float $penetrationChance): ItemPropertiesAmmoInterface
    {
        $this->penetrationChance = $penetrationChance;

        return $this;
    }

    public function getPenetrationPower(): int
    {
        return $this->penetrationPower;
    }

    public function setPenetrationPower(int $penetrationPower): ItemPropertiesAmmoInterface
    {
        $this->penetrationPower = $penetrationPower;

        return $this;
    }

    public function getAccuracyModifier(): float
    {
        return $this->accuracyModifier;
    }

    public function setAccuracyModifier(float $accuracyModifier): ItemPropertiesAmmoInterface
    {
        $this->accuracyModifier = $accuracyModifier;

        return $this;
    }

    public function getRecoilModifier(): float
    {
        return $this->recoilModifier;
    }

    public function setRecoilModifier(float $recoilModifier): ItemPropertiesAmmoInterface
    {
        $this->recoilModifier = $recoilModifier;

        return $this;
    }

    public function getInitialSpeed(): float
    {
        return $this->initialSpeed;
    }

    public function setInitialSpeed(float $initialSpeed): ItemPropertiesAmmoInterface
    {
        $this->initialSpeed = $initialSpeed;

        return $this;
    }

    public function getLightBleedModifier(): float
    {
        return $this->lightBleedModifier;
    }

    public function setLightBleedModifier(float $lightBleedModifier): ItemPropertiesAmmoInterface
    {
        $this->lightBleedModifier = $lightBleedModifier;

        return $this;
    }

    public function getHeavyBleedModifier(): float
    {
        return $this->heavyBleedModifier;
    }

    public function setHeavyBleedModifier(float $heavyBleedModifier): ItemPropertiesAmmoInterface
    {
        $this->heavyBleedModifier = $heavyBleedModifier;

        return $this;
    }

    public function getDurabilityBurnFactor(): float
    {
        return $this->durabilityBurnFactor;
    }

    public function setDurabilityBurnFactor(float $durabilityBurnFactor): ItemPropertiesAmmoInterface
    {
        $this->durabilityBurnFactor = $durabilityBurnFactor;

        return $this;
    }

    public function getHeatFactor(): float
    {
        return $this->heatFactor;
    }

    public function setHeatFactor(float $heatFactor): ItemPropertiesAmmoInterface
    {
        $this->heatFactor = $heatFactor;

        return $this;
    }

    public function getStaminaBurnPerDamage(): float
    {
        return $this->staminaBurnPerDamage;
    }

    public function setStaminaBurnPerDamage(float $staminaBurnPerDamage): ItemPropertiesAmmoInterface
    {
        $this->staminaBurnPerDamage = $staminaBurnPerDamage;

        return $this;
    }

    public function getBallisticCoefficient(): float
    {
        return $this->ballisticCoefficient;
    }

    public function setBallisticCoefficient(float $ballisticCoefficient): ItemPropertiesAmmoInterface
    {
        $this->ballisticCoefficient = $ballisticCoefficient;

        return $this;
    }

    public function getBulletDiameterMillimeters(): float
    {
        return $this->bulletDiameterMillimeters;
    }

    public function setBulletDiameterMillimeters(float $bulletDiameterMillimeters): ItemPropertiesAmmoInterface
    {
        $this->bulletDiameterMillimeters = $bulletDiameterMillimeters;

        return $this;
    }

    public function getBulletMassGrams(): float
    {
        return $this->bulletMassGrams;
    }

    public function setBulletMassGrams(float $bulletMassGrams): ItemPropertiesAmmoInterface
    {
        $this->bulletMassGrams = $bulletMassGrams;

        return $this;
    }
}
