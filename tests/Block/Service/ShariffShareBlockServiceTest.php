<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Tests\Block\Service;

use Core23\ShariffBundle\Block\Service\ShariffShareBlockService;
use Sonata\BlockBundle\Block\BlockContext;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Sonata\BlockBundle\Model\Block;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\BlockBundle\Test\BlockServiceTestCase;

final class ShariffShareBlockServiceTest extends BlockServiceTestCase
{
    public function testDefaultSettings(): void
    {
        $blockService = new ShariffShareBlockService($this->templating);
        $blockContext = $this->getBlockContext($blockService);

        $this->assertSettings([
            'url'            => null,
            'class'          => null,
            'services'       => ['twitter', 'facebook', 'googleplus'],
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'flattrUser'     => null,
            'flattrCategory' => null,
            'template'       => '@Core23Shariff/Block/block_shariff.html.twig',
        ], $blockContext);
    }

    public function testExecute(): void
    {
        $block = new Block();

        $blockContext = new BlockContext($block, [
            'url'            => null,
            'class'          => null,
            'services'       => ['twitter', 'facebook', 'googleplus'],
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'flattrUser'     => null,
            'flattrCategory' => null,
            'template'       => '@Core23Shariff/Block/block_shariff.html.twig',
        ]);

        $blockService = new ShariffShareBlockService($this->templating);
        $blockService->execute($blockContext);

        static::assertSame('@Core23Shariff/Block/block_shariff.html.twig', $this->templating->view);

        static::assertSame($blockContext, $this->templating->parameters['context']);
        static::assertIsArray($this->templating->parameters['settings']);
        static::assertInstanceOf(BlockInterface::class, $this->templating->parameters['block']);
    }

    public function testGetMetadata(): void
    {
        $blockService = new ShariffShareBlockService($this->templating);

        $metadata = $blockService->getMetadata();

        static::assertSame('core23_shariff.block.share', $metadata->getTitle());
        static::assertNull($metadata->getImage());
        static::assertSame('Core23ShariffBundle', $metadata->getDomain());
        static::assertSame([
            'class' => 'fa fa-share-square-o',
        ], $metadata->getOptions());
    }

    public function testConfigureEditForm(): void
    {
        $blockService = new ShariffShareBlockService($this->templating);

        $block = new Block();

        $formMapper = $this->createMock(FormMapper::class);
        $formMapper->expects(static::once())->method('add');

        $blockService->configureEditForm($formMapper, $block);
    }
}
