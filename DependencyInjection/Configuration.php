<?php

namespace Beyerz\ApiClientBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('beyerz_api_client');

        $rootNode->children()
                ->arrayNode('apis')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('manager')
                                ->info("Your custom manager class service, should start with an @")
                            ->end()
                            ->scalarNode('base_url')
                                ->info("The base url to use for your api connection")
                            ->end()
                            ->arrayNode('options')
                                ->info("See the GuzzleHttp options list for options that you can use")
                                ->useAttributeAsKey('name')
                                ->prototype('scalar')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
