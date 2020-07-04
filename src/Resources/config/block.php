<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Nucleos\ShariffBundle\Block\Service\ShariffShareBlockService;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container): void {
    $container->services()

        ->set('nucleos_shariff.block.share', ShariffShareBlockService::class)
            ->tag('sonata.block')
            ->args([
                new Reference('twig'),
            ])

    ;
};
