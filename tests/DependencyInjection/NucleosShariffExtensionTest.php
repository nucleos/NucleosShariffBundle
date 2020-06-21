<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Nucleos\ShariffBundle\DependencyInjection\NucleosShariffExtension;
use Nucleos\ShariffBundle\Service\AddThis;
use Nucleos\ShariffBundle\Service\Buffer;
use Nucleos\ShariffBundle\Service\Facebook;
use Nucleos\ShariffBundle\Service\Pinterest;
use Nucleos\ShariffBundle\Service\Reddit;
use Nucleos\ShariffBundle\Service\StumbleUpon;
use Nucleos\ShariffBundle\Service\Vk;
use Nucleos\ShariffBundle\Service\Xing;

final class NucleosShariffExtensionTest extends AbstractExtensionTestCase
{
    public function testLoadDefault(): void
    {
        $this->load([
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
        ]);

        $this->assertContainerBuilderHasParameter('nucleos_shariff.services', [
            'addthis', 'buffer', 'pinterest', 'reddit', 'stumbleupon', 'vk', 'xing',
        ]);

        $this->assertContainerBuilderNotHasService(Facebook::class);
    }

    public function testVerifyServices(): void
    {
        $this->load([
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
        ]);

        $this->assertContainerBuilderHasService(AddThis::class);
        $this->assertContainerBuilderHasService(Buffer::class);
        $this->assertContainerBuilderHasService(Pinterest::class);
        $this->assertContainerBuilderHasService(Reddit::class);
        $this->assertContainerBuilderHasService(StumbleUpon::class);
        $this->assertContainerBuilderHasService(Vk::class);
        $this->assertContainerBuilderHasService(Xing::class);
    }

    public function testLoadFacebook(): void
    {
        $this->load([
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
            'services'        => [
                'facebook' => [
                    'app_id'  => 'foo_id',
                    'secret'  => 'app_secret',
                    'version' => '1.0',
                ],
            ],
        ]);

        $this->assertContainerBuilderHasParameter('nucleos_shariff.services', [
            'addthis', 'buffer', 'facebook', 'pinterest', 'reddit', 'stumbleupon', 'vk', 'xing',
        ]);

        $this->assertContainerBuilderHasParameter('nucleos_shariff.service.facebook.app_id', 'foo_id');
        $this->assertContainerBuilderHasParameter('nucleos_shariff.service.facebook.secret', 'app_secret');
        $this->assertContainerBuilderHasParameter('nucleos_shariff.service.facebook.version', '1.0');

        $this->assertContainerBuilderHasService(Facebook::class);
    }

    protected function getContainerExtensions(): array
    {
        return [
            new NucleosShariffExtension(),
        ];
    }
}
