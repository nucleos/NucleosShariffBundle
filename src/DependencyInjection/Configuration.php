<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('core23_shariff');

        // Keep compatibility with symfony/config < 4.2
        if (!method_exists(TreeBuilder::class, 'getRootNode')) {
            $rootNode = $treeBuilder->root('core23_shariff');
        } else {
            $rootNode = $treeBuilder->getRootNode();
        }
        \assert($rootNode instanceof ArrayNodeDefinition);

        $this->addOptions($rootNode);
        $this->addServices($rootNode);

        return $treeBuilder;
    }

    private function addOptions(NodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('options')
                    ->fixXmlConfig('domain')
                    ->fixXmlConfig('service')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('domains')
                            ->defaultValue([])
                            ->prototype('scalar')->end()
                        ->end()
                        ->arrayNode('services')
                            ->defaultValue(['GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'])
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;
    }

    private function addServices(NodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('services')
                    ->children()
                        ->arrayNode('facebook')
                        ->children()
                            ->scalarNode('app_id')->end()
                            ->scalarNode('secret')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;
    }
}
