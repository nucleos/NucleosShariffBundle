<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Tests\DependencyInjection;

use Core23\ShariffBundle\DependencyInjection\Core23ShariffExtension;
use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;

class Core23ShariffExtensionTest extends AbstractExtensionTestCase
{
    public function testLoadDefault()
    {
        $this->load();

        $this->assertContainerBuilderHasParameter('core23_shariff.options', array(
            'domains'  => array(),
            'services' => array('GooglePlus', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'),
        ));
    }

    public function testLoadFacebook()
    {
        $this->load(array(
            'services' => array(
                'facebook' => array(
                    'app_id' => 'foo_id',
                    'secret' => 'app_secret',
                ),
            ),
        ));

        $this->assertContainerBuilderHasParameter('core23_shariff.options', array(
            'domains'  => array(),
            'services' => array('GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'),
            'Facebook' => array(
                'app_id' => 'foo_id',
                'secret' => 'app_secret',
            ),
        ));
    }

    protected function getContainerExtensions(): array
    {
        return array(
            new Core23ShariffExtension(),
        );
    }
}
