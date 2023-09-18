<?php

declare(strict_types=1);

namespace App\Doctrine;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslationInterface;

class LocaleFilter extends SQLFilter
{
    public function addFilterConstraint(ClassMetadata $targetEntity, $targetTableAlias): string
    {
        if ( is_subclass_of($targetEntity->name, TranslationInterface::class)) {
//            dump($targetEntity, $targetTableAlias);
            return sprintf('%s.locale = \'%s\'', 't1_.locale', 'en');
        }

        return '';
    }
}