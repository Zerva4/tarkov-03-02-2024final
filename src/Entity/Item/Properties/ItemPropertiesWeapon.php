<?php

declare(strict_types=1);

namespace App\Entity\Item\Properties;

use App\Entity\Item\Item;
use App\Interfaces\Item\ItemInterface;
use App\Interfaces\Item\Properties\ItemPropertiesInterface;
use App\Interfaces\Item\Properties\ItemPropertiesWeaponInterface;
use App\Repository\Item\ItemPropertiesWeaponRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Table(name: 'items_properties_weapon', options: ['comment' => 'Свойств для оружия'])]
#[ORM\Entity(repositoryClass: ItemPropertiesWeaponRepository::class)]
class ItemPropertiesWeapon extends ItemProperties implements ItemPropertiesInterface, ItemPropertiesWeaponInterface
{
    #[ORM\Column(type: 'string', length: 64, nullable: false, options: ['default' => '', 'comment' => 'Калибр'])]
    private string $apiCaliber;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Эффективная дистанция'])]
    private int $effectiveDistance;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Эффективная дистанция'])]
    private float $ergonomics;

    // todo: Сделать многоязычность
    #[ORM\Column(type: 'json', nullable: true, options: ["jsonb" => true, 'comment' => 'Режимы стрельбы'])]
    private ?array $fireModes = null;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Скорострельность'])]
    private int $fireRate;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Макс. прочность'])]
    private int $maxDurability;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Вертикальная отдача'])]
    private int $recoilVertical;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Горизонтальная отдача'])]
    private int $recoilHorizontal;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Стоимость ремонта за 1 ед.'])]
    private int $repairCost;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Прицельная дальность'])]
    private int $sightingRange;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => ' Центр воздействия'])]
    private float $centerOfImpact;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Кривая отклонения'])]
    private float $deviationCurve;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Дисперсия отдачи'])]
    private int $recoilDispersion;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Угол отдачи'])]
    private int $recoilAngle;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Отдача камеры'])]
    private float $cameraRecoil;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Щелчок камеры'])]
    private float $cameraSnap;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Макс. отклонение'])]
    private float $deviationMax;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Конвергенция'])]
    private float $convergence;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Ширина по умолчанию'])]
    private int $defaultWidth;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Высота по умолчанию'])]
    private int $defaultHeight;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Стандартная эргономика'])]
    private float $defaultErgonomics;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Вертикальная отдача по умолчанию'])]
    private int $defaultRecoilVertical;

    #[ORM\Column(type: 'integer', nullable: false, options: ['default' => 0, 'comment' => 'Горизонтальная отдача по умолчанию'])]
    private int $defaultRecoilHorizontal;

    #[ORM\Column(type: 'float', nullable: false, options: ['default' => 0, 'comment' => 'Вес по умолчанию'])]
    private float $defaultWeight;

    #[ORM\OneToOne(targetEntity: Item::class, cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: false, onDelete: 'SET NULL')]
    private ?ItemInterface $defaultAmmo;
    
    #[ORM\OneToOne(targetEntity: Item::class, cascade: ['persist'], fetch: 'EAGER')]
    #[ORM\JoinColumn(referencedColumnName: 'id', unique: false, onDelete: 'SET NULL')]
    private ?ItemInterface $defaultPreset = null;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'presetsWeapons', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'items_properties_weapon_presets')]
    private Collection $allowedPresets;

    #[ORM\ManyToMany(targetEntity: Item::class, inversedBy: 'allowedWeapons', cascade: ['persist'], fetch: 'EXTRA_LAZY', orphanRemoval: false)]
    #[ORM\JoinTable(name: 'items_properties_weapon_ammo')]
    private ?Collection $allowedAmmo;

    public function __construct()
    {
        $this->allowedPresets = new ArrayCollection();
        $this->allowedAmmo = new ArrayCollection();
    }

    public function getApiCaliber(): string
    {
        return $this->apiCaliber;
    }

    public function setApiCaliber(string $apiCaliber): ItemPropertiesWeaponInterface
    {
        $this->apiCaliber = $apiCaliber;

        return $this;
    }

    public function getEffectiveDistance(): int
    {
        return $this->effectiveDistance;
    }

    public function setEffectiveDistance(int $effectiveDistance): ItemPropertiesWeaponInterface
    {
        $this->effectiveDistance = $effectiveDistance;

        return $this;
    }

    public function getErgonomics(): float
    {
        return $this->ergonomics;
    }

    public function setErgonomics(float $ergonomics): ItemPropertiesWeaponInterface
    {
        $this->ergonomics = $ergonomics;

        return $this;
    }

    public function getFireModes(): ?array
    {
        return $this->fireModes;
    }

    public function setFireModes(?array $fireModes): ItemPropertiesWeaponInterface
    {
        $this->fireModes = $fireModes;

        return $this;
    }

    public function getFireRate(): int
    {
        return $this->fireRate;
    }

    public function setFireRate(int $fireRate): ItemPropertiesWeaponInterface
    {
        $this->fireRate = $fireRate;

        return $this;
    }

    public function getMaxDurability(): int
    {
        return $this->maxDurability;
    }

    public function setMaxDurability(int $maxDurability): ItemPropertiesWeaponInterface
    {
        $this->maxDurability = $maxDurability;

        return $this;
    }

    public function getRecoilVertical(): int
    {
        return $this->recoilVertical;
    }

    public function setRecoilVertical(int $recoilVertical): ItemPropertiesWeaponInterface
    {
        $this->recoilVertical = $recoilVertical;

        return $this;
    }

    public function getRecoilHorizontal(): int
    {
        return $this->recoilHorizontal;
    }

    public function setRecoilHorizontal(int $recoilHorizontal): ItemPropertiesWeaponInterface
    {
        $this->recoilHorizontal = $recoilHorizontal;

        return $this;
    }

    public function getRepairCost(): int
    {
        return $this->repairCost;
    }

    public function setRepairCost(int $repairCost): ItemPropertiesWeaponInterface
    {
        $this->repairCost = $repairCost;

        return $this;
    }

    public function getSightingRange(): int
    {
        return $this->sightingRange;
    }

    public function setSightingRange(int $sightingRange): ItemPropertiesWeaponInterface
    {
        $this->sightingRange = $sightingRange;

        return $this;
    }

    public function getCenterOfImpact(): float
    {
        return $this->centerOfImpact;
    }

    public function setCenterOfImpact(float $centerOfImpact): ItemPropertiesWeaponInterface
    {
        $this->centerOfImpact = $centerOfImpact;

        return $this;
    }

    public function getDeviationCurve(): float
    {
        return $this->deviationCurve;
    }

    public function setDeviationCurve(float $deviationCurve): ItemPropertiesWeaponInterface
    {
        $this->deviationCurve = $deviationCurve;

        return $this;
    }

    public function getRecoilDispersion(): int
    {
        return $this->recoilDispersion;
    }

    public function setRecoilDispersion(int $recoilDispersion): ItemPropertiesWeaponInterface
    {
        $this->recoilDispersion = $recoilDispersion;

        return $this;
    }

    public function getRecoilAngle(): int
    {
        return $this->recoilAngle;
    }

    public function setRecoilAngle(int $recoilAngle): ItemPropertiesWeaponInterface
    {
        $this->recoilAngle = $recoilAngle;

        return $this;
    }

    public function getCameraRecoil(): float
    {
        return $this->cameraRecoil;
    }

    public function setCameraRecoil(float $cameraRecoil): ItemPropertiesWeaponInterface
    {
        $this->cameraRecoil = $cameraRecoil;

        return $this;
    }

    public function getCameraSnap(): float
    {
        return $this->cameraSnap;
    }

    public function setCameraSnap(float $cameraSnap): ItemPropertiesWeaponInterface
    {
        $this->cameraSnap = $cameraSnap;

        return $this;
    }

    public function getDeviationMax(): float
    {
        return $this->deviationMax;
    }

    public function setDeviationMax(float $deviationMax): ItemPropertiesWeaponInterface
    {
        $this->deviationMax = $deviationMax;

        return $this;
    }

    public function getConvergence(): float
    {
        return $this->convergence;
    }

    public function setConvergence(float $convergence): ItemPropertiesWeaponInterface
    {
        $this->convergence = $convergence;

        return $this;
    }

    public function getDefaultWidth(): int
    {
        return $this->defaultWidth;
    }

    public function setDefaultWidth(int $defaultWidth): ItemPropertiesWeaponInterface
    {
        $this->defaultWidth = $defaultWidth;

        return $this;
    }

    public function getDefaultHeight(): int
    {
        return $this->defaultHeight;
    }

    public function setDefaultHeight(int $defaultHeight): ItemPropertiesWeaponInterface
    {
        $this->defaultHeight = $defaultHeight;

        return $this;
    }

    public function getDefaultErgonomics(): float
    {
        return $this->defaultErgonomics;
    }

    public function setDefaultErgonomics(float $defaultErgonomics): ItemPropertiesWeaponInterface
    {
        $this->defaultErgonomics = $defaultErgonomics;

        return $this;
    }

    public function getDefaultRecoilVertical(): int
    {
        return $this->defaultRecoilVertical;
    }

    public function setDefaultRecoilVertical(int $defaultRecoilVertical): ItemPropertiesWeaponInterface
    {
        $this->defaultRecoilVertical = $defaultRecoilVertical;

        return $this;
    }

    public function getDefaultRecoilHorizontal(): int
    {
        return $this->defaultRecoilHorizontal;
    }

    public function setDefaultRecoilHorizontal(int $defaultRecoilHorizontal): ItemPropertiesWeaponInterface
    {
        $this->defaultRecoilHorizontal = $defaultRecoilHorizontal;

        return $this;
    }

    public function getDefaultWeight(): float
    {
        return $this->defaultWeight;
    }

    public function setDefaultWeight(float $defaultWeight): ItemPropertiesWeaponInterface
    {
        $this->defaultWeight = $defaultWeight;

        return $this;
    }

    public function getDefaultAmmo(): ?ItemInterface
    {
        return $this->defaultAmmo;
    }

    public function setDefaultAmmo(?ItemInterface $defaultAmmo): ItemPropertiesWeaponInterface
    {
        $this->defaultAmmo = $defaultAmmo;

        return $this;
    }

    public function getDefaultPreset(): ?ItemInterface
    {
        return $this->defaultPreset;
    }

    public function setDefaultPreset(?ItemInterface $defaultPreset): ItemPropertiesWeaponInterface
    {
        $this->defaultPreset = $defaultPreset;

        return $this;
    }

    public function getAllowedPresets(): Collection
    {
        return $this->allowedPresets;
    }

    public function setAllowedPresets(Collection $allowedPresets): ItemPropertiesWeaponInterface
    {
        $this->allowedPresets = $allowedPresets;

        return $this;
    }

    public function addAllowedPreset(ItemInterface $preset): ItemPropertiesWeaponInterface
    {
        if (!$this->allowedPresets->contains($preset)) {
            $this->allowedPresets->add($preset);
            $preset->addPresetsWeapon($this);
        }

        return $this;
    }

    public function removeAllowedPreset(ItemInterface $preset): ItemPropertiesWeaponInterface
    {
        if ($this->allowedPresets->contains($preset)) {
            $this->allowedPresets->removeElement($preset);
            $preset->removePresetsWeapon($this);
        }

        return $this;
    }

    public function getAllowedAmmo(): ?Collection
    {
        return $this->allowedAmmo;
    }

    public function setAllowedAmmo(?Collection $allowedAmmo): ItemPropertiesWeaponInterface
    {
        $this->allowedAmmo = $allowedAmmo;

        return $this;
    }

    public function addAllowedAmmo(ItemInterface $ammo): ItemPropertiesWeaponInterface
    {
        if (!$this->allowedAmmo->contains($ammo)) {
            $this->allowedAmmo->add($ammo);
            $ammo->addAllowedWeapon($this);
        }

        return $this;
    }

    public function removeAllowedAmmo(ItemInterface $ammo): ItemPropertiesWeaponInterface
    {
        if ($this->allowedAmmo->contains($ammo)) {
            $this->allowedAmmo->removeElement($ammo);
            $ammo->removeAllowedWeapon($this);
        }

        return $this;
    }
}
