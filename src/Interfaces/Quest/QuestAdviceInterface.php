<?php

namespace App\Interfaces\Quest;

interface QuestAdviceInterface
{
    public function isPublished(): bool;
    public function setPublished(bool $published): QuestAdviceInterface;
    public function getBody(): string;
    public function setBody(string $body): QuestAdviceInterface;
}