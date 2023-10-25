<?php

namespace App\Security;

use CKSource\Bundle\CKFinderBundle\Authentication\Authentication;

class CKFinderAuthentication extends Authentication
{
    public function authenticate(): bool
    {
        return true;
    }
}