<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class Core23ShariffExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('block.xml');
        $loader->load('services.xml');

        $options = $config['options'];

        if (empty($config['services']['facebook']['app_id']) || empty($config['services']['facebook']['secret'])) {
            $options['services'] = array_values(array_diff($options['services'], array('Facebook')));
        } else {
            $options['Facebook'] = $config['services']['facebook'];
        }

        $container->setParameter('core23_shariff.options', $options);
    }
}
