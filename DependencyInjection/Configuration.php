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
    const SCALAR_MANAGER = 'manager';

    const ENDPOINT_URL = 'base_url';
    const ENDPOINT_WSDL = 'wsdl';

    const CUSTOM_OPTIONS = 'options';

    const ENGINE_JSON = 'json';
    const ENGINE_XML = 'xml';
    const ENGINE_SOAP = 'soap';



    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('beyerz_api_client');

        $rootNode->children()
                ->append($this->addJsonParametersNode())
                ->append($this->addXMLParametersNode())
                ->append($this->addSoapParametersNode())
            ->end();

        return $treeBuilder;
    }

    public function addJsonParametersNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root(self::ENGINE_JSON);

        $node->prototype('array')
            ->children()
                ->scalarNode(self::SCALAR_MANAGER)
                    ->isRequired()
                    ->info("Your custom manager class service, should start with an @")
                ->end()
                ->scalarNode(self::ENDPOINT_URL)
                    ->isRequired()
                    ->info("The base url to use for your api connection")
                ->end()
                ->arrayNode(self::CUSTOM_OPTIONS)
                    ->info("See the GuzzleHttp options list for options that you can use")
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ->end();

        return $node;
    }

    public function addSoapParametersNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root(self::ENGINE_SOAP);

        $node->prototype('array')
            ->children()
                ->scalarNode(self::SCALAR_MANAGER)
                    ->isRequired()
                    ->info("Your custom manager class service, should start with an @")
                ->end()
                ->scalarNode(self::ENDPOINT_WSDL)
                    ->isRequired()
                    ->info("The path to the wsdl")
                ->end()
                ->arrayNode(self::CUSTOM_OPTIONS)
                    ->info("See the BesimpleSoap options list for options that you can use")
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ->end();

        return $node;
    }

    public function addXMLParametersNode()
    {
        $builder = new TreeBuilder();
        $node = $builder->root(self::ENGINE_XML);

        $node->prototype('array')
            ->children()
                ->scalarNode(self::SCALAR_MANAGER)
                    ->isRequired()
                    ->info("Your custom manager class service, should start with an @")
                ->end()
                ->scalarNode(self::ENDPOINT_URL)
                    ->isRequired()
                    ->info("The base url to use for your api connection")
                ->end()
                ->arrayNode(self::CUSTOM_OPTIONS)
                    ->info("See the GuzzleHttp options list for options that you can use")
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ->end();

        return $node;
    }
}
