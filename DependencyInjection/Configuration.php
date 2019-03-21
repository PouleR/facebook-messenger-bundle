<?php

namespace PouleR\FacebookMessengerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('pouler_facebook_messenger');
        if (method_exists($treeBuilder, 'getRootNode')) {
            $rootNode = $treeBuilder->getRootNode();
        } else {
            // BC layer for symfony/config 4.1 and older
            $rootNode = $treeBuilder->root('pouler_facebook_messenger');
        }

        $rootNode
            ->children()
                ->scalarNode('app_id')->defaultValue('fb_app_id')->end()
                ->scalarNode('app_secret')->defaultValue('fb_app_secret')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
