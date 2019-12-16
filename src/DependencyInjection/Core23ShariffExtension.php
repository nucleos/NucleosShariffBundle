<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\DependencyInjection;

use Core23\ShariffBundle\Service\Facebook;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class Core23ShariffExtension extends Extension
{
    /**
     * @param array<mixed> $configs
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('action.xml');
        $loader->load('block.xml');
        $loader->load('services.xml');

        $this->configureAliases($container, $config);
        $this->configureDomains($container, $config);
        $this->configureServices($container, $config);
    }

    /**
     * @param array<mixed> $config
     */
    private function configureServices(ContainerBuilder $container, array $config): void
    {
        $services = $config['options']['services'];
        $facebook = $config['services']['facebook'] ?? null;

        if (
            !isset($facebook['app_id'], $facebook['secret']) ||
            null === $facebook['app_id'] || null === $facebook['secret']
        ) {
            if (false !== ($key = array_search('facebook', $services, true))) {
                unset($services[$key]);
            }

            $container->removeDefinition(Facebook::class);
        } else {
            $container->setParameter('core23_shariff.service.facebook.app_id', $facebook['app_id']);
            $container->setParameter('core23_shariff.service.facebook.secret', $facebook['secret']);
            $container->setParameter('core23_shariff.service.facebook.version', $facebook['version'] ?? null);
        }

        $container->setParameter('core23_shariff.services', array_values($services));
    }

    /**
     * @param array<mixed> $config
     */
    private function configureAliases(ContainerBuilder $container, array $config): void
    {
        $container->setAlias('core23_shariff.cache', $config['cache']);
        $container->setAlias('core23_shariff.http_client', $config['http_client']);
        $container->setAlias('core23_shariff.request_factory', $config['request_factory']);
    }

    /**
     * @param array<mixed> $config
     */
    private function configureDomains(ContainerBuilder $container, array $config): void
    {
        $container->setParameter('core23_shariff.domains', $config['options']['domains']);
    }
}
