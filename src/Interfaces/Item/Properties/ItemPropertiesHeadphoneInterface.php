<?php

declare(strict_types=1);

namespace App\Interfaces\Item\Properties;

interface ItemPropertiesHeadphoneInterface
{
    public function getAmbientVolume(): int;
    public function setAmbientVolume(int $ambientVolume): ItemPropertiesHeadphoneInterface;
    public function getCompressorAttack(): int;
    public function setCompressorAttack(int $compressorAttack): ItemPropertiesHeadphoneInterface;
    public function getCompressorGain(): int;
    public function setCompressorGain(int $compressorGain): ItemPropertiesHeadphoneInterface;
    public function getCompressorRelease(): int;
    public function setCompressorRelease(int $compressorRelease): ItemPropertiesHeadphoneInterface;
    public function getCompressorThreshold(): int;
    public function setCompressorThreshold(int $compressorThreshold): ItemPropertiesHeadphoneInterface;
    public function getCompressorVolume(): int;
    public function setCompressorVolume(int $compressorVolume): ItemPropertiesHeadphoneInterface;
    public function getCutoffFrequency(): int;
    public function setCutoffFrequency(int $cutoffFrequency): ItemPropertiesHeadphoneInterface;
    public function getDistanceModifier(): float;
    public function setDistanceModifier(float $distanceModifier): ItemPropertiesHeadphoneInterface;
    public function getDistortion(): float;
    public function setDistortion(float $distortion): ItemPropertiesHeadphoneInterface;
    public function getDryVolume(): int;
    public function setDryVolume(int $dryVolume): ItemPropertiesHeadphoneInterface;
    public function getHighFrequencyGain(): float;
    public function setHighFrequencyGain(float $highFrequencyGain): ItemPropertiesHeadphoneInterface;
    public function getResonance(): float;
    public function setResonance(float $resonance): ItemPropertiesHeadphoneInterface;
}