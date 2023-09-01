<?php

declare(strict_types=1);

namespace App\Interfaces\Quest;

use App\Interfaces\Item\ItemInterface;
use App\Interfaces\MapInterface;

interface QuestKeyInterface
{
    /**
     * @return ItemInterface|null
     */
    public function getItem(): ?ItemInterface;

    /**
     * @param ItemInterface|null $item
     * @return QuestKeyInterface
     */
    public function setItem(?ItemInterface $item): QuestKeyInterface;

    /**
     * @return MapInterface|null
     */
    public function getMap(): ?MapInterface;

    /**
     * @param MapInterface|null $map
     * @return QuestKeyInterface
     */
    public function setMap(?MapInterface $map): QuestKeyInterface;

    /**
     * @return QuestInterface|null
     */
    public function getQuest(): ?QuestInterface;

    /**
     * @param QuestInterface|null $quest
     * @return QuestKeyInterface
     */
    public function setQuest(?QuestInterface $quest): QuestKeyInterface;
}