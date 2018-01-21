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
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

final class Core23ShariffExtensionTest extends AbstractExtensionTestCase
{
    public function testLoadDefault(): void
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('core23_shariff.options', [
            'domains'  => [],
            'services' => ['GooglePlus', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'],
        ]);
    }

    public function testLoadFacebook(): void
    {
        $this->load([
            'services' => [
                'facebook' => [
                    'app_id' => 'foo_id',
                    'secret' => 'app_secret',
                ],
            ],
        ]);

        $this->assertContainerBuilderHasParameter('core23_shariff.options', [
            'domains'  => [],
            'services' => ['GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'],
            'Facebook' => [
                'app_id' => 'foo_id',
                'secret' => 'app_secret',
            ],
        ]);
    }

    protected function getContainerExtensions(): array
    {
        return [
            new Core23ShariffExtension(),
        ];
    }
}
