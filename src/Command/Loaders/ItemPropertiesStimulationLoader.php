<?php

namespace App\Command\Loaders;

use App\Entity\Item\StimulationEffect;
use App\Interfaces\Item\Properties\ItemPropertiesStimulationInterface;
use App\Interfaces\Item\StimulationEffectInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesStimulationLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesStimulationInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesStimulationInterface
    {
        $entityProperties
            ->setUseTime($arrayProperties['useTime'] ?? 0)
            ->setCures($arrayProperties['cures'] ?? [])
        ;

        if (!isset($arrayProperties['stimEffects'])) return $entityProperties;

        foreach ($arrayProperties['stimEffects'] as $apiEffects) {
            $stimulationEffectEntity = new StimulationEffect($locale);
            $stimulationEffectEntity
                ->setType($apiEffects['useTime'] ?? null)
                ->setChance($apiEffects['chance'] ?? null)
                ->setDelay($apiEffects['delay'] ?? null)
                ->setDuration($apiEffects['duration'] ?? 0)
                ->setValue($apiEffects['value'] ?? null)
                ->setPercent($apiEffects['percent'] ?? false)
                ->setSkillName($apiEffects['skillName'] ?? 0)
            ;
            $stimulationEffectEntity->mergeNewTranslations();
            $entityProperties->addStimulationEffect($stimulationEffectEntity);
        }

        return $entityProperties;
    }
}