<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Tests\App;

use Nucleos\ShariffBundle\NucleosShariffBundle;
use Sonata\BlockBundle\SonataBlockBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

final class AppKernel extends Kernel
{
    use MicroKernelTrait;

    public function __construct()
    {
        parent::__construct('test', false);
    }

    public function registerBundles()
    {
        yield new FrameworkBundle();
        yield new TwigBundle();
        yield new SonataBlockBundle();
        yield new NucleosShariffBundle();
    }

    public function getCacheDir(): string
    {
        return $this->getBaseDir().'cache';
    }

    public function getLogDir(): string
    {
        return $this->getBaseDir().'log';
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    protected function configureRoutes(RouteCollectionBuilder $routes): void
    {
        $routes->import(__DIR__.'/../../src/Resources/config/routing/backend.yml');
    }

    protected function configureContainer(ContainerBuilder $containerBuilder, LoaderInterface $loader): void
    {
        $loader->load(__DIR__.'/config/config.yaml');
    }

    private function getBaseDir(): string
    {
        return sys_get_temp_dir().'/app-bundle/var/';
    }
}