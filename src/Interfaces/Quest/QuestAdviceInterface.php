<?php

namespace App\Interfaces\Quest;

use Doctrine\Common\Collections\Collection;

interface QuestAdviceInterface
{
    public function isPublished(): bool;
    public function setPublished(bool $published): QuestAdviceInterface;
    public function getBody(): string;
    public function setBody(string $body): QuestAdviceInterface;
    public function getQuests(): Collection;
    public function setQuests(Collection $quests): QuestAdviceInterface;
    public function addQuest(QuestInterface $quest): QuestAdviceInterface;
    public function removeQuest(QuestInterface $quest): QuestAdviceInterface;
}