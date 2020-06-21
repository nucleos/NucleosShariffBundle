<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\DependencyInjection\Compiler;

use Nucleos\ShariffBundle\Manager\StaticServiceManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ShariffCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        $serviceManager    = $container->findDefinition(StaticServiceManager::class);

        $services = [];

        foreach ($container->findTaggedServiceIds('nucleos.shariff') as $id => $attributes) {
            $definition = $container->getDefinition($id);
            $definition->setPublic(true);

            $services[] = new Reference($id);
        }

        $serviceManager->replaceArgument(0, $services);
    }
}
