<?php

namespace Beyerz\ApiAdapterBundle\DependencyInjection;

use Beyerz\ApiAdapterBundle\Exception\MissingDependencyException;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class BeyerzApiAdapterExtension extends Extension implements PrependExtensionInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

    /**
     * @param ContainerBuilder $container
     *
     * @throws MissingDependencyException
     */
    public function prepend(ContainerBuilder $container)
    {
        $bundles = $container->getParameter('kernel.bundles');

        if (!isset($bundles['CsaGuzzleBundle'])) {
            throw new MissingDependencyException("CsaGuzzleBundle required, please ensure that it was properly included");
        }

        if (!isset($bundles['BeSimpleSoapBundle'])) {
            throw new MissingDependencyException("BeSimpleSoapBundle required, please ensure that it was properly included");
        }

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        $soap = $config['soap'];
        $json = $config['json'];
        $xml = $config['xml'];

        $this->prependSoap($container, $soap);
        $this->prependJson($container, $json);
        $this->prependXML($container, $xml);

    }

    protected function prependSoap(ContainerBuilder $container, array $config)
    {
        foreach ($config as $api => $settings) {
            $prependConfig['clients'][$api] = [
                'wsdl' => $settings[Configuration::ENDPOINT_WSDL],
            ];
            $container->prependExtensionConfig('be_simple_soap', $prependConfig);
        }
    }

    protected function prependJson(ContainerBuilder $container, array $config)
    {
        foreach ($config as $api => $settings) {
            $prependConfig['profiler'] = '%kernel.debug%';
            $prependConfig['logger'] = '%kernel.debug%';
            $prependConfig['clients'][$api] = [
                'lazy'   => true,
                'config' => array_merge(['base_uri' => $settings['base_url']], $settings['options']),
            ];
            $container->prependExtensionConfig('csa_guzzle', $prependConfig);
        }
    }

    protected function prependXML(ContainerBuilder $container, array $config)
    {
        foreach ($config as $api => $settings) {
            $prependConfig['profiler'] = '%kernel.debug%';
            $prependConfig['logger'] = '%kernel.debug%';
            $prependConfig['clients'][$api] = [
                'lazy'   => true,
                'config' => array_merge(['base_uri' => $settings['base_url']], $settings['options']),
            ];
            $container->prependExtensionConfig('csa_guzzle', $prependConfig);
        }
    }
}
