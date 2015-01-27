<?php

namespace Nm\AdflyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('nm_adfly');

        $rootNode
                ->children()
                    ->scalarNode('url')
                        ->defaultValue('http://api.adf.ly/api.php')
                    ->end()
                    ->scalarNode('key')->end()
                    ->scalarNode('uid')->end()
                    ->scalarNode('advert_type')
                        ->defaultValue('int')
                    ->end()
                    ->scalarNode('domain')
                        ->defaultValue('adf.ly')
                    ->end()
                ->end();

        return $treeBuilder;
    }
}
