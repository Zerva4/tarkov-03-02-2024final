<?php

namespace App\Command\Loaders;

use App\Entity\Item\StimulationEffect;
use App\Interfaces\Item\ItemPropertiesFoodDrinkInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesFoodDrinkLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesFoodDrinkInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesFoodDrinkInterface
    {
        $entityStimulationEffect = $entityProperties->getStimulationEffect();

        $entityProperties
            ->setEnergy($arrayProperties['energy'])
            ->setHydration($arrayProperties['hydration'])
            ->setUnits($arrayProperties['units'])
        ;

        if (!isset($arrayProperties['stimEffects'])) return $entityProperties;

        if (null === $entityStimulationEffect) {
            $entityStimulationEffect = new StimulationEffect($locale);
            $entityProperties->setStimulationEffect($entityStimulationEffect);
        }

//        dump($arrayProperties['stimEffects']);

        $entityStimulationEffect
            ->setType($arrayProperties['stimEffects']['type'])
            ->setChance($arrayProperties['stimEffects']['chance'])
            ->setDelay($arrayProperties['stimEffects']['delay'])
            ->setDuration($arrayProperties['stimEffects']['duration'])
            ->setValue($arrayProperties['stimEffects']['value'])
            ->setPercent($arrayProperties['stimEffects']['percent'])
            ->setSkillName($arrayProperties['stimEffects']['skillName'])
        ;
        $entityStimulationEffect->mergeNewTranslations();
        $em->persist($entityStimulationEffect);

        return $entityProperties;
    }
}