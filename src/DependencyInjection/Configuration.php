<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('nucleos_shariff');

        $rootNode = $treeBuilder->getRootNode();

        $this->addAliases($rootNode);
        $this->addOptions($rootNode);
        $this->addServices($rootNode);

        return $treeBuilder;
    }

    private function addAliases(NodeDefinition $node): void
    {
        $node
            ->children()
                ->scalarNode('cache')->isRequired()->end()
                ->scalarNode('http_client')->isRequired()->end()
                ->scalarNode('request_factory')->isRequired()->end()
            ->end()
            ;
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
                            ->defaultValue(['addthis', 'buffer', 'facebook', 'pinterest', 'reddit', 'stumbleupon', 'vk', 'xing'])
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
                            ->scalarNode('version')->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
            ;
    }
}
