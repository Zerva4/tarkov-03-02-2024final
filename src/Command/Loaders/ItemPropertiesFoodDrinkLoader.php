<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Entity\Item\StimulationEffect;
use App\Interfaces\Item\Properties\ItemPropertiesFoodDrinkInterface;
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
        $entityStimulationEffect = $entityProperties->getStimulationEffects();

        $entityProperties
            ->setEnergy($arrayProperties['energy'])
            ->setHydration($arrayProperties['hydration'])
            ->setUnits($arrayProperties['units'])
        ;

        if (!isset($arrayProperties['stimEffects'])) return $entityProperties;

        foreach ($arrayProperties['stimEffects'] as $effect) {
            $entityStimulationEffect = new StimulationEffect($locale);
            $entityStimulationEffect
                ->setType($effect['type'] ?? '')
                ->setChance($effect['chance'] ?? 0)
                ->setDelay($effect['delay'] ?? 0)
                ->setDuration($effect['duration'] ?? 0)
                ->setValue($effect['value'] ?? 0)
                ->setPercent($effect['percent'] ?? false)
                ->setSkillName($effect['skillName'] ?? '')
            ;
            $entityStimulationEffect->mergeNewTranslations();
            $entityProperties->addStimulationEffect($entityStimulationEffect);
        }
//        dump($arrayProperties['stimEffects']);
//        $em->persist($entityStimulationEffect);
//        $entityProperties->addStimulationEffect($entityStimulationEffect);


        return $entityProperties;
    }
}