<?php

namespace App\Interfaces\Item;

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
    public function getDistanceModifier(): int;
    public function setDistanceModifier(int $distanceModifier): ItemPropertiesHeadphoneInterface;
    public function getDistortion(): int;
    public function setDistortion(int $distortion): ItemPropertiesHeadphoneInterface;
    public function getDryVolume(): int;
    public function setDryVolume(int $dryVolume): ItemPropertiesHeadphoneInterface;
    public function getHighFrequencyGain(): int;
    public function setHighFrequencyGain(int $highFrequencyGain): ItemPropertiesHeadphoneInterface;
    public function getResonance(): int;
    public function setResonance(int $resonance): ItemPropertiesHeadphoneInterface;
}