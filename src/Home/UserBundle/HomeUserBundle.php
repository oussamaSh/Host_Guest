<?php

namespace Home\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HomeUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
