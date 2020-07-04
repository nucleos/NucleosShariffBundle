<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Nucleos\ShariffBundle\Action\BackendAction;
use Nucleos\ShariffBundle\Backend\Backend;
use Symfony\Component\DependencyInjection\Reference;

return static function (ContainerConfigurator $container): void {
    $container->services()

        ->set(BackendAction::class)
            ->public()
            ->args([
                new Reference(Backend::class),
            ])

    ;
};
