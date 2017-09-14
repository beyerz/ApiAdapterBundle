<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 14/09/2017
 * Time: 10:21
 */

namespace Beyerz\ApiAdapterBundle\DependencyInjection\CompilerPass;


use Beyerz\ApiAdapterBundle\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ClientPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     *
     * @throws \Exception
     */
    public function process(ContainerBuilder $container)
    {
        $configs = $this->getExtensionConfig($container);

        foreach ($configs as $api => $clients) {
            foreach ($clients as $client => $clientConfig) {
                //locate the already defined service for this client and add the alias
                $alias = sprintf("beyerz.api.client.%s", $client);
                switch ($api) {
                    case Configuration::ENGINE_JSON:
                    case Configuration::ENGINE_XML:
                        $id = sprintf("csa_guzzle.client.%s", $client);
                        $this->setAlias($container, $alias, $id);
                        break;
                    case Configuration::ENGINE_SOAP:
                        $id = sprintf("besimple.soap.client.%s", $client);
                        $this->setAlias($container, $alias, $id);
                        break;
                    default:
                        throw new \Exception("Unknown/not supported api type: " . $api);
                }
            }
        }
    }

    /**
     * Get the config for this bundle
     *
     * @param ContainerBuilder $container
     *
     * @return array
     */
    private function getExtensionConfig(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig("beyerz_api_client");
        $configuration = new Configuration();
        $processor = new Processor();

        return $processor->processConfiguration($configuration, $configs);
    }

    /**
     * Add an alias to an existing definition
     *
     * @param ContainerBuilder $container
     * @param String           $alias
     * @param String           $id
     */
    private function setAlias(ContainerBuilder $container, $alias, $id)
    {
        if ($container->hasDefinition($id)) {
            $container->setAlias($alias, $id);
        }
    }
}