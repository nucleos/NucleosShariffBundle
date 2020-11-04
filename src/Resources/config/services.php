<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Nucleos\ShariffBundle\Backend\Backend;
use Nucleos\ShariffBundle\Backend\PsrBackend;
use Nucleos\ShariffBundle\Manager\ServiceManager;
use Nucleos\ShariffBundle\Manager\StaticServiceManager;
use Nucleos\ShariffBundle\Service\Facebook;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Parameter;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container): void {
    $services = $container->services();

    $services
        ->load('Nucleos\\ShariffBundle\\Service\\', '../../Service')
            ->exclude('../../Service/{Exception,Facebook}')
            ->public()
            ->tag('nucleos.shariff')

        ->set(Facebook::class)
            ->public()
            ->tag('nucleos.shariff')
            ->args([
                new Parameter('nucleos_shariff.service.facebook.app_id'),
                new Parameter('nucleos_shariff.service.facebook.secret'),
                new Parameter('nucleos_shariff.service.facebook.version'),
            ])

        ->set(StaticServiceManager::class)
            ->args([
                [],
                new Parameter('nucleos_shariff.services'),
            ])

        ->set(PsrBackend::class)
            ->args([
                new Reference(ServiceManager::class),
                new Reference('nucleos_shariff.request_factory'),
                new Reference('nucleos_shariff.http_client'),
                new Reference('nucleos_shariff.cache'),
                new Parameter('nucleos_shariff.domains'),
            ])
            ->call('setLogger', [
                new Reference('logger', ContainerInterface::IGNORE_ON_UNINITIALIZED_REFERENCE),
            ])

        ->alias(ServiceManager::class, StaticServiceManager::class)

        ->alias(Backend::class, PsrBackend::class)

    ;
};
