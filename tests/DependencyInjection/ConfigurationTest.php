<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Tests\DependencyInjection;

use Core23\ShariffBundle\DependencyInjection\Configuration;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\Definition\Processor;

final class ConfigurationTest extends TestCase
{
    public function testDefaultOptions(): void
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), [[]]);

        $expected = [
            'options' => [
                'domains'  => [],
                'services' => ['GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'],
            ],
        ];

        static::assertSame($expected, $config);
    }

    public function testOptions(): void
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), [[
            'options' => [
                'domain'  => 'http://foo.bar',
                'service' => 'GooglePlus',
            ],
        ]]);

        $expected = [
            'options' => [
                'domains'  => ['http://foo.bar'],
                'services' => ['GooglePlus'],
            ],
        ];

        static::assertSame($expected, $config);
    }
}
