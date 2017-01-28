<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('core23_shariff')->children();

        $rootNode
            ->arrayNode('options')
                ->fixXmlConfig('domain')
                ->fixXmlConfig('service')
                ->addDefaultsIfNotSet()
                ->children()
                    ->arrayNode('domains')
                        ->defaultValue(array())
                        ->prototype('scalar')->end()
                    ->end()
                    ->arrayNode('services')
                        ->defaultValue(array('GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'))
                        ->prototype('scalar')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
