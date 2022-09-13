<?php

declare(strict_types=1);

namespace App\Entity;

use App\Traits\TranslatableMagicMethodsTrait;
use Knp\DoctrineBehaviors\Contract\Entity\TimestampableInterface;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Timestampable\TimestampableTrait;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

class TranslatableEntity implements TimestampableInterface, TranslatableInterface
{
    use TimestampableTrait;
    use TranslatableTrait;
    use TranslatableMagicMethodsTrait;

    public function __construct(string $defaultLocation = '%app.default_locale%')
    {
        $this->defaultLocale = $defaultLocation;
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