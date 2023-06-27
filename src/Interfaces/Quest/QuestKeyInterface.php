<?php

namespace App\Interfaces\Quest;

use App\Interfaces\Item\ItemInterface;
use App\Interfaces\MapInterface;

interface QuestKeyInterface
{
    /**
     * @return ItemInterface|null
     */
    public function getKey(): ?ItemInterface;

    /**
     * @param ItemInterface|null $key
     * @return QuestKeyInterface
     */
    public function setKey(?ItemInterface $key): QuestKeyInterface;

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