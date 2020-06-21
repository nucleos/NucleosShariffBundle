<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Tests\DependencyInjection;

use Nucleos\ShariffBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

final class ConfigurationTest extends TestCase
{
    public function testDefaultOptions(): void
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), [[
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
        ]]);

        $expected = [
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
            'options'         => [
                'domains'  => [],
                'services' => ['addthis', 'buffer', 'facebook', 'pinterest', 'reddit', 'stumbleupon', 'vk', 'xing'],
            ],
        ];

        static::assertSame($expected, $config);
    }

    public function testOptions(): void
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), [[
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
            'options'         => [
                'domain'  => 'http://foo.bar',
                'service' => 'GooglePlus',
            ],
        ]]);

        $expected = [
            'cache'           => 'my.cache',
            'http_client'     => 'my.http_client',
            'request_factory' => 'my.request_factory',
            'options'         => [
                'domains'  => ['http://foo.bar'],
                'services' => ['GooglePlus'],
            ],
        ];

        static::assertSame($expected, $config);
    }
}
