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
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('pouler_facebook_messenger');

        $rootNode
            ->children()
                ->scalarNode('app_id')->defaultValue('fb_app_id')->end()
                ->scalarNode('app_secret')->defaultValue('fb_app_secret')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
