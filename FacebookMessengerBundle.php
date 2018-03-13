<?php

namespace PouleR\FacebookMessengerBundle;

use PouleR\FacebookMessengerBundle\DependencyInjection\FacebookMessengerExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class FacebookMessengerBundle.
 */
class FacebookMessengerBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension()
    {
        return new FacebookMessengerExtension();
    }
}
