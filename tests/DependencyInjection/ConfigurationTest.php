<?php

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

class ConfigurationTest extends TestCase
{
    public function testDefaultOptions()
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), array(array()));

        $expected = array(
            'options' => array(
                'domains'  => array(),
                'services' => array('GooglePlus', 'Facebook', 'LinkedIn', 'Reddit', 'StumbleUpon', 'Flattr', 'Pinterest', 'Xing', 'AddThis'),
            ),
        );

        $this->assertSame($expected, $config);
    }

    public function testOptions()
    {
        $processor = new Processor();

        $config = $processor->processConfiguration(new Configuration(), array(array(
            'options' => array(
                'domain'  => 'http://foo.bar',
                'service' => 'GooglePlus',
            ),
        )));

        $expected = array(
            'options' => array(
                'domains'  => array('http://foo.bar'),
                'services' => array('GooglePlus'),
            ),
        );

        $this->assertSame($expected, $config);
    }
}
