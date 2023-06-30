<?php

namespace App\Interfaces\Item;

use App\Interfaces\Quest\QuestInterface;
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
    public function getTypeProperties(): ?string;

    /**
     * @param string $typeProperties
     * @return ItemInterface
     */
    public function setTypeProperties(string $typeProperties): ItemInterface;

    /**
     * @return array|null
     */
    public function getProperties(): ?array;

    /**
     * @param array|null $properties
     * @return ItemInterface
     */
    public function setProperties(?array $properties): ItemInterface;

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
     * @return float|null
     */
    public function getAccuracyModifier(): ?float;

    /**
     * @param float|null $accuracyModifier
     * @return ItemInterface
     */
    public function setAccuracyModifier(?float $accuracyModifier): ItemInterface;

    /**
     * @return float|null
     */
    public function getRecoilModifier(): ?float;

    /**
     * @param float|null $recoilModifier
     * @return ItemInterface
     */
    public function setRecoilModifier(?float $recoilModifier): ItemInterface;

    /**
     * @return float|null
     */
    public function getErgonomicsModifier(): ?float;

    /**
     * @param float|null $ergonomicsModifier
     * @return ItemInterface
     */
    public function setErgonomicsModifier(?float $ergonomicsModifier): ItemInterface;

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
     * @return bool
     */
    public function isBlocksHeadphones(): bool;

    /**
     * @param bool $blocksHeadphones
     * @return ItemInterface
     */
    public function setBlocksHeadphones(bool $blocksHeadphones): ItemInterface;

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
     * @return float|null
     */
    public function getVelocity(): ?float;

    /**
     * @param float|null $velocity
     * @return ItemInterface
     */
    public function setVelocity(?float $velocity): ItemInterface;

    /**
     * @return int|null
     */
    public function getLoudness(): ?int;

    /**
     * @param int|null $loudness
     * @return ItemInterface
     */
    public function setLoudness(?int $loudness): ItemInterface;

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
     * @return Collection|null
     */
    public function getQuestsKeys(): ?Collection;

    /**
     * @param Collection|null $neededInQuests
     * @return ItemInterface
     */
    public function setQuestsKeys(?Collection $neededInQuests): ItemInterface;

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
}