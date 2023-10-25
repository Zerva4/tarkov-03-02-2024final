<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\TranslatableMagicMethodsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

abstract class TranslatableEntity implements TimestampableInterface, TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    public function __construct(string $defaultLocale = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocale;
        $this->translations = new ArrayCollection();
    }

    private function proxyCurrentLocaleTranslation(string $method, array $arguments = [])
    {
        if (!method_exists(self::getTranslationEntityClass(), $method)) {
            $method = 'get' . ucfirst($method);
        }

        $translation = $this->translate($this->getCurrentLocale());

        return (method_exists(self::getTranslationEntityClass(), $method)) ? call_user_func_array([$translation, $method], $arguments) : null;
    }
}