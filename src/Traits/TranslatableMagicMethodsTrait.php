<?php

declare(strict_types=1);

namespace App\Traits;

use Symfony\Component\PropertyAccess\PropertyAccess;

trait TranslatableMagicMethodsTrait
{
    public function __call($method, $arguments)
    {
        return PropertyAccess::createPropertyAccessor()->getValue($this->translate(), $method);
    }

    public function __get($name)
    {
        $method = 'get'. ucfirst($name);
        $arguments=[];
        return self::proxyCurrentLocaleTranslation($method, $arguments);
    }
}