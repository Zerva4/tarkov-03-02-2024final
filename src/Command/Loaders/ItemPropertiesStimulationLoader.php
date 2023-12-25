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
        $stimulationEffectEntity = $entityProperties->getStimulationEffect();

        if (!$stimulationEffectEntity instanceof StimulationEffectInterface)
            $stimulationEffectEntity = new StimulationEffect($locale);

        $stimulationEffectEntity
            ->setCurrentLocale($locale)
        ;
        $stimulationEffectEntity
            ->setType($arrayProperties['stimEffects']['useTime'] ?? null)
            ->setChance($arrayProperties['stimEffects']['chance'] ?? null)
            ->setDelay($arrayProperties['stimEffects']['delay'] ?? null)
            ->setDuration($arrayProperties['stimEffects']['duration'] ?? 0)
            ->setValue($arrayProperties['stimEffects']['value'] ?? null)
            ->setPercent($arrayProperties['stimEffects']['percent'] ?? false)
            ->setSkillName($arrayProperties['stimEffects']['skillName'] ?? 0)
        ;

        $entityProperties
            ->setUseTime($arrayProperties['useTime'] ?? 0)
            ->setCures($arrayProperties['cures'] ?? [])
            ->setStimulationEffect($stimulationEffectEntity)
        ;
        return $entityProperties;
    }
}