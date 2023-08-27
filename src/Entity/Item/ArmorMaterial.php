<?php

declare(strict_types=1);

namespace App\Entity\Item;

use App\Interfaces\Item\ArmorMaterialInterface;
use App\Interfaces\UuidPrimaryKeyInterface;
use App\Repository\Item\ArmorMaterialRepository;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Table(name: 'armor_materials', options: ['comment' => 'Таблица для материалов брони'])]
#[ORM\Index(columns: ['api_id'], name: 'armor_materials_api_key_idx')]
#[ORM\Entity(repositoryClass: ArmorMaterialRepository::class)]
class ArmorMaterial implements ArmorMaterialInterface, UuidPrimaryKeyInterface, TimestampableInterface, TranslatableInterface
{
    use UuidPrimaryKeyTrait;
    use TimestampableTrait;
    use TranslatableTrait;

    #[ORM\Column(type: 'string', length: 32, unique: true, nullable: false, options: ['default' => '', 'comment' => 'Идентификатор API'])]
    private string $apiId;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Разрушаемость'])]
    private float $destructibility;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Мин. деградация при ремонте'])]
    private float $minRepairDegradation;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Макс. деградация при ремонте'])]
    private float $maxRepairDegradation;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Разрущаемость от взрыва'])]
    private float $explosionDestructibility;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Мин. деградация ремкомплектапри ремонте'])]
    private float $minRepairKitDegradation;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0.0, 'comment' => 'Макс. деградация ремкомплектапри ремонте'])]
    private float $maxRepairKitDegradation;

    public function getApiId(): string
    {
        return $this->apiId;
    }

    public function setApiId(string $apiId): ArmorMaterialInterface
    {
        $this->apiId = $apiId;

        return $this;
    }

    public function getDestructibility(): float
    {
        return $this->destructibility;
    }

    public function setDestructibility(float $destructibility): ArmorMaterialInterface
    {
        $this->destructibility = $destructibility;

        return $this;
    }

    public function getMinRepairDegradation(): float
    {
        return $this->minRepairDegradation;
    }

    public function setMinRepairDegradation(float $minRepairDegradation): ArmorMaterialInterface
    {
        $this->minRepairDegradation = $minRepairDegradation;

        return $this;
    }

    public function getMaxRepairDegradation(): float
    {
        return $this->maxRepairDegradation;
    }

    public function setMaxRepairDegradation(float $maxRepairDegradation): ArmorMaterialInterface
    {
        $this->maxRepairDegradation = $maxRepairDegradation;

        return $this;
    }

    public function getExplosionDestructibility(): float
    {
        return $this->explosionDestructibility;
    }

    public function setExplosionDestructibility(float $explosionDestructibility): ArmorMaterialInterface
    {
        $this->explosionDestructibility = $explosionDestructibility;

        return $this;
    }

    public function getMinRepairKitDegradation(): float
    {
        return $this->minRepairKitDegradation;
    }

    public function setMinRepairKitDegradation(float $minRepairKitDegradation): ArmorMaterialInterface
    {
        $this->minRepairKitDegradation = $minRepairKitDegradation;

        return $this;
    }

    public function getMaxRepairKitDegradation(): float
    {
        return $this->maxRepairKitDegradation;
    }

    public function setMaxRepairKitDegradation(float $maxRepairKitDegradation): ArmorMaterialInterface
    {
        $this->maxRepairKitDegradation = $maxRepairKitDegradation;

        return $this;
    }
}
