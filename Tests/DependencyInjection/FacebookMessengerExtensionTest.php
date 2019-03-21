<?php

namespace PouleR\FacebookMessengerBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use PouleR\FacebookMessengerBundle\DependencyInjection\FacebookMessengerExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class FacebookMessengerExtensionTest
 */
class FacebookMessengerExtensionTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConfigLoad()
    {
        $container = new ContainerBuilder();
        $config = [];

        $extension = new FacebookMessengerExtension();
        $extension->load($config, $container);

        // Test if arguments are overwritten with default values from config
        $definition = $container->getDefinition('pouler.facebookmessenger.service');
        $arguments = $definition->getArguments();

        self::assertEquals('fb_app_id', $arguments[0]);
        self::assertEquals('fb_app_secret', $arguments[1]);
    }
}
