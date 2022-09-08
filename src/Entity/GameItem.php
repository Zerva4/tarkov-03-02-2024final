<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use App\Traits\SlugTrait;
use App\Traits\UuidPrimaryKeyTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items')]
#[ORM\Index(columns: ['slug'], name: 'item_slug_idx')]
#[ORM\Index(columns: ['api_id'], name: 'item_api_key_idx')]
#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item extends BaseEntity
{
    use UuidPrimaryKeyTrait;
    use SlugTrait;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $apiId;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $slug;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $basePrice = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $width = null;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $height = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $backgroundColor = null;

    /**
     * @var float|null Модификатор точности
     */
    #[ORM\Column(type: 'float', length: 255, nullable: true)]
    private ?float $accuracyModifier = null;

    /**
     * @var float|null Модификатор отдачи
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $recoilModifier = null;

    /**
     * @var float|null Модификатор эргономики
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $ergonomicsModifier = null;

    /**
     * @var bool Модуль рукоятки
     */
    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $hasGrid = false;

    /**
     * @var bool 
     */
    #[ORM\Column(type: 'boolean', options: ['default' => 0])]
    private bool $blocksHeadphones = false;

    /**
     * @var float|null Масса
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $weight = null;

    /**
     * @var float|null Скорость
     */
    #[ORM\Column(type: 'float', nullable: true)]
    private ?float $velocity = null;

    /**
     * @return string
     */
    public function getApiId(): string
    {
        return $this->apiId;
    }

    /**
     * @param string $apiId
     */
    public function setApiId(string $apiId): void
    {
        $this->apiId = $apiId;
    }

    /**
     * @return float|null
     */
    public function getAccuracyModifier(): ?float
    {
        return $this->accuracyModifier;
    }

    /**
     * @param float|null $accuracyModifier
     */
    public function setAccuracyModifier(?float $accuracyModifier): void
    {
        $this->accuracyModifier = $accuracyModifier;
    }

    /**
     * @return float|null
     */
    public function getRecoilModifier(): ?float
    {
        return $this->recoilModifier;
    }

    /**
     * @param float|null $recoilModifier
     */
    public function setRecoilModifier(?float $recoilModifier): void
    {
        $this->recoilModifier = $recoilModifier;
    }

    /**
     * @return float|null
     */
    public function getErgonomicsModifier(): ?float
    {
        return $this->ergonomicsModifier;
    }

    /**
     * @param float|null $ergonomicsModifier
     */
    public function setErgonomicsModifier(?float $ergonomicsModifier): void
    {
        $this->ergonomicsModifier = $ergonomicsModifier;
    }
}
