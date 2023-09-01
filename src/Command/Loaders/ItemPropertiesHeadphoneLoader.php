<?php

declare(strict_types=1);

namespace App\Command\Loaders;

use App\Interfaces\Item\ItemPropertiesHeadphoneInterface;
use Doctrine\ORM\EntityManagerInterface;

class ItemPropertiesHeadphoneLoader
{
    public function load(
        EntityManagerInterface $em,
        ItemPropertiesHeadphoneInterface $entityProperties,
        array $arrayProperties,
        string $locale = '%app.default_locale%'
    ): ItemPropertiesHeadphoneInterface
    {
        $entityProperties
            ->setAmbientVolume($arrayProperties['ambientVolume'] ?? 0)
            ->setCompressorAttack($arrayProperties['compressorAttack'] ?? 0)
            ->setCompressorGain($arrayProperties['compressorGain'] ?? 0)
            ->setCompressorRelease($arrayProperties['compressorRelease'] ?? 0)
            ->setCompressorThreshold($arrayProperties['compressorThreshold'] ?? 0)
            ->setCompressorVolume($arrayProperties['compressorVolume'] ?? 0)
            ->setCutoffFrequency($arrayProperties['cutoffFrequency'] ?? 0)
            ->setDistanceModifier($arrayProperties['distanceModifier'] ?? 0)
            ->setDistortion($arrayProperties['distortion'] ?? 0)
            ->setDryVolume($arrayProperties['dryVolume'] ?? 0)
            ->setHighFrequencyGain($arrayProperties['highFrequencyGain'] ?? 0)
            ->setResonance($arrayProperties['resonance'] ?? 0)
        ;
        return $entityProperties;
    }
}