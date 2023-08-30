<?php

declare(strict_types=1);

namespace App\Interfaces\Item;

use App\Interfaces\Quest\QuestKeyInterface;
use App\Interfaces\Trader\TraderCashOfferInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Interface for Item entity.
 */
interface ItemInterface
{
    /**
     * @return string
     */
    public function getApiId(): string;

    /**
     * @param string $apiId
     * @return ItemInterface
     */
    public function setApiId(string $apiId): ItemInterface;

    /**
     * @return string|null
     */
    public function getTypeItem(): ?string;

    /**
     * @param string $typeItem
     * @return ItemInterface
     */
    public function setTypeItem(string $typeItem): ItemInterface;

    /**
     * @return array|null
     */
    public function getProperties(): ?ItemPropertiesInterface;

    /**
     * @param ItemPropertiesInterface|null $properties
     * @return ItemInterface
     */
    public function setProperties(?ItemPropertiesInterface $properties): ItemInterface;

    /**
     * @return bool
     */
    public function isPublished(): bool;

    /**
     * @param bool $published
     * @return ItemInterface
     */
    public function setPublished(bool $published): ItemInterface;

    /**
     * @return string
     */
    public function getSlug(): string;

    /**
     * @param string $slug
     * @return ItemInterface
     */
    public function setSlug(string $slug): ItemInterface;

    /**
     * @return array
     */
    public function getTypes(): array;

    /**
     * @param array $types
     * @return ItemInterface
     */
    public function setTypes(array $types): ItemInterface;

    /**
     * @return int|null
     */
    public function getBasePrice(): ?int;

    /**
     * @param int|null $basePrice
     * @return ItemInterface
     */
    public function setBasePrice(?int $basePrice): ItemInterface;

    /**
     * @return int|null
     */
    public function getWidth(): ?int;

    /**
     * @param int|null $width
     * @return ItemInterface
     */
    public function setWidth(?int $width): ItemInterface;

    /**
     * @return int|null
     */
    public function getHeight(): ?int;

    /**
     * @param int|null $height
     * @return ItemInterface
     */
    public function setHeight(?int $height): ItemInterface;

    /**
     * @return string|null
     */
    public function getBackgroundColor(): ?string;

    /**
     * @param string|null $backgroundColor
     * @return ItemInterface
     */
    public function setBackgroundColor(?string $backgroundColor): ItemInterface;

    /**
     * @return bool
     */
    public function isHasGrid(): bool;

    /**
     * @param bool $hasGrid
     * @return ItemInterface
     */
    public function setHasGrid(bool $hasGrid): ItemInterface;

    /**
     * @return float|null
     */
    public function getWeight(): ?float;

    /**
     * @param float|null $weight
     * @return ItemInterface
     */
    public function setWeight(?float $weight): ItemInterface;

    /**
     * @return string|null
     */
    public function getImageName(): ?string;

    /**
     * @param string|null $imageName
     * @return ItemInterface
     */
    public function setImageName(?string $imageName): ItemInterface;

    /**
     * @return Collection
     */
    public function getContainedItems(): Collection;

    /**
     * @param Collection $containedItems
     * @return ItemInterface
     */
    public function setContainedItems(Collection $containedItems): ItemInterface;

    /**
     * @param ContainedItemInterface $containedItem
     * @return ItemInterface
     */
    public function addContainedItem(ContainedItemInterface $containedItem): ItemInterface;

    /**
     * @param ContainedItemInterface $containedItem
     * @return ItemInterface
     */
    public function removeContainedItem(ContainedItemInterface $containedItem): ItemInterface;

    /**
     * @return Collection
     */
    public function getCashOffers(): Collection;

    /**
     * @param Collection $cashOffers
     * @return ItemInterface
     */
    public function setCashOffers(Collection $cashOffers): ItemInterface;

    /**
     * @param TraderCashOfferInterface $cashOffer
     * @return ItemInterface
     */
    public function addCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface;

    /**
     * @param TraderCashOfferInterface $cashOffer
     * @return ItemInterface
     */
    public function removeCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface;

    /**
     * @return Collection
     */
    public function getCurrencyCashOffers(): Collection;

    /**
     * @param Collection $currencyCashOffers
     * @return ItemInterface
     */
    public function setCurrencyCashOffers(Collection $currencyCashOffers): ItemInterface;

    /**
     * @param TraderCashOfferInterface $cashOffer
     * @return ItemInterface
     */
    public function addCurrencyCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface;

    /**
     * @param TraderCashOfferInterface $cashOffer
     * @return ItemInterface
     */
    public function removeCurrencyCashOffer(TraderCashOfferInterface $cashOffer): ItemInterface;

    /**
     * @return Collection|null
     */
    public function getQuestsKeys(): ?Collection;

    /**
     * @param Collection|null $questsKeys
     * @return ItemInterface
     */
    public function setQuestsKeys(?Collection $questsKeys): ItemInterface;

    /**
     * @param QuestKeyInterface $questKey
     * @return ItemInterface
     */
    public function addQuestsKey(QuestKeyInterface $questKey): ItemInterface;

    /**
     * @param QuestKeyInterface $questKey
     * @return ItemInterface
     */
    public function removeQuestsKey(QuestKeyInterface $questKey): ItemInterface;

    /**
     * @return Collection|null
     */
    public function getAllowedMagazine(): ?Collection;

    /**
     * @param Collection|null $allowedMagazine
     * @return ItemInterface
     */
    public function setAllowedMagazine(?Collection $allowedMagazine): ItemInterface;

    /**
     * @param ItemPropertiesMagazineInterface $itemPropertiesMagazine
     * @return ItemInterface
     */
    public function addAllowedMagazine(ItemPropertiesMagazineInterface $itemPropertiesMagazine): ItemInterface;

    /**
     * @param ItemPropertiesMagazineInterface $itemPropertiesMagazine
     * @return ItemInterface
     */
    public function removeAllowedMagazine(ItemPropertiesMagazineInterface $itemPropertiesMagazine): ItemInterface;

    /**
     * @return Collection|null
     */
    public function getPresetsWeapons(): ?Collection;

    /**
     * @param Collection|null $presetsWeapons
     * @return ItemInterface
     */
    public function setPresetsWeapons(?Collection $presetsWeapons): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function addPresetsWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function removePresetsWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @return Collection|null
     */
    public function getAllowedWeapons(): ?Collection;

    /**
     * @param Collection|null $allowedWeapons
     * @return ItemInterface
     */
    public function setAllowedWeapons(?Collection $allowedWeapons): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function addAllowedWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function removeAllowedWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @return Collection
     */
    public function getDefaultWeapons(): Collection;

    /**
     * @param Collection $defaultWeapons
     * @return ItemInterface
     */
    public function setDefaultWeapons(Collection $defaultWeapons): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function addDefaultWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function removeDefaultWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @return Collection
     */
    public function getPresetDefaultWeapons(): Collection;

    /**
     * @param Collection $presetDefaultWeapons
     * @return ItemInterface
     */
    public function setPresetDefaultWeapons(Collection $presetDefaultWeapons): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function addPresetDefaultWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;

    /**
     * @param ItemPropertiesWeaponInterface $itemPropertiesWeapon
     * @return ItemInterface
     */
    public function removePresetDefaultWeapon(ItemPropertiesWeaponInterface $itemPropertiesWeapon): ItemInterface;
}