<?php

namespace Beyerz\ApiClientBundle\DependencyInjection;

use Beyerz\ApiClientBundle\Exception\MissingDependencyException;
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
class BeyerzApiClientExtension extends Extension implements PrependExtensionInterface
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

        $configs = $container->getExtensionConfig($this->getAlias());
        $config = $this->processConfiguration(new Configuration(), $configs);

        var_dump($config);
        die;
//        if (isset($config['auth_token']) && isset($config['account_sid'])) {
//            $prependConfig['profiler'] = '%kernel.debug%';
//            $prependConfig['logger'] = '%kernel.debug%';
//            $prependConfig['clients']['chizla_emailage'] = [
//                'lazy'   => true,
//                'config' => [
//                    'base_uri'    => $config['sandbox'] === true ? self::EMAILAGE_SANDBOX_URI : self::EMAILAGE_PRODUCTION_URI,
//                    'auth_token'  => $config['auth_token'],
//                    'account_sid' => $config['account_sid'],
//                ],
//            ];
//            $container->prependExtensionConfig('csa_guzzle', $prependConfig);
//        }
    }
}
