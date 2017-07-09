<?php

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Tests\Block\Service;

use Core23\ShariffBundle\Block\Service\ShariffShareBlockService;
use Sonata\BlockBundle\Block\BlockContext;
use Sonata\BlockBundle\Model\Block;
use Sonata\BlockBundle\Test\AbstractBlockServiceTestCase;
use Sonata\BlockBundle\Model\BlockInterface;

class ShariffShareBlockServiceTest extends AbstractBlockServiceTestCase
{
    public function testDefaultSettings()
    {
        $blockService = new ShariffShareBlockService('block.service', $this->templating);
        $blockContext = $this->getBlockContext($blockService);

        $this->assertSettings(array(
            'url'            => null,
            'class'          => '',
            'services'       => array('twitter', 'facebook', 'googleplus'),
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'flattrUser'     => null,
            'flattrCategory' => null,
            'template'       => 'Core23ShariffBundle:Block:block_shariff.html.twig',
        ), $blockContext);
    }

    public function testExecute()
    {
        $block = new Block();

        $blockContext = new BlockContext($block, array(
            'url'            => null,
            'class'          => '',
            'services'       => array('twitter', 'facebook', 'googleplus'),
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'flattrUser'     => null,
            'flattrCategory' => null,
            'template'       => 'Core23ShariffBundle:Block:block_shariff.html.twig',
        ));

        $blockService = new ShariffShareBlockService('block.service', $this->templating);
        $blockService->execute($blockContext);

        $this->assertSame('Core23ShariffBundle:Block:block_shariff.html.twig', $this->templating->view);

        $this->assertSame($blockContext, $this->templating->parameters['context']);
        $this->assertInternalType('array', $this->templating->parameters['settings']);
        $this->assertInstanceOf(BlockInterface::class, $this->templating->parameters['block']);
    }
}
