<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Tests\DependencyInjection;

use Core23\ShariffBundle\DependencyInjection\Core23ShariffExtension;
use Core23\ShariffBundle\Service\AddThis;
use Core23\ShariffBundle\Service\Buffer;
use Core23\ShariffBundle\Service\Facebook;
use Core23\ShariffBundle\Service\Pinterest;
use Core23\ShariffBundle\Service\Reddit;
use Core23\ShariffBundle\Service\StumbleUpon;
use Core23\ShariffBundle\Service\Vk;
use Core23\ShariffBundle\Service\Xing;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

final class Core23ShariffExtensionTest extends AbstractExtensionTestCase
{
    public function testLoadDefault(): void
    {
        $this->load([
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
        ]);

        $this->assertContainerBuilderHasParameter('core23_shariff.services', [
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

        $this->assertContainerBuilderHasParameter('core23_shariff.services', [
            'addthis', 'buffer', 'facebook', 'pinterest', 'reddit', 'stumbleupon', 'vk', 'xing',
        ]);

        $this->assertContainerBuilderHasParameter('core23_shariff.service.facebook.app_id', 'foo_id');
        $this->assertContainerBuilderHasParameter('core23_shariff.service.facebook.secret', 'app_secret');
        $this->assertContainerBuilderHasParameter('core23_shariff.service.facebook.version', '1.0');

        $this->assertContainerBuilderHasService(Facebook::class);
    }

    protected function getContainerExtensions(): array
    {
        return [
            new Core23ShariffExtension(),
        ];
    }
}
