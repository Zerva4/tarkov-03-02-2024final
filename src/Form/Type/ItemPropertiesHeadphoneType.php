<?php

declare(strict_types=1);

namespace App\Form\Type;

use App\Entity\Item\Properties\ItemPropertiesHeadphone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use function Symfony\Component\Translation\t;

class ItemPropertiesHeadphoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ambientVolume', IntegerType::class, [
                'label' => t('Ambient volume', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('compressorAttack', IntegerType::class, [
                'label' => t('Compressor attack', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('compressorGain', IntegerType::class, [
                'label' => t('Compressor gain', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('compressorRelease', IntegerType::class, [
                'label' => t('Compressor release', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('compressorThreshold', IntegerType::class, [
                'label' => t('Compressor threshold', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('compressorVolume', IntegerType::class, [
                'label' => t('Compressor volume', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('cutoffFrequency', IntegerType::class, [
                'label' => t('Cutoff frequency', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('distanceModifier', NumberType::class, [
                'label' => t('Distance modifier', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('distortion', NumberType::class, [
                'label' => t('Distortion', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('dryVolume', IntegerType::class, [
                'label' => t('Dry volume', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('highFrequencyGain', NumberType::class, [
                'label' => t('High frequency gain', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
            ->add('resonance', NumberType::class, [
                'label' => t('Resonance', [], 'admin.properties.items'),
                'required' => true,
                'empty_data' => 0.0,
                'constraints' => [
                    new NotBlank()
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemPropertiesHeadphone::class,
        ]);
    }
}
