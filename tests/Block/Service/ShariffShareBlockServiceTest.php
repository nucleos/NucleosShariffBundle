<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Tests\Block\Service;

use LogicException;
use Nucleos\ShariffBundle\Block\Service\ShariffShareBlockService;
use Sonata\BlockBundle\Block\BlockContext;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Sonata\BlockBundle\Model\Block;
use Sonata\BlockBundle\Test\BlockServiceTestCase;
use Symfony\Component\HttpFoundation\Response;

final class ShariffShareBlockServiceTest extends BlockServiceTestCase
{
    public function testDefaultSettings(): void
    {
        $blockService = new ShariffShareBlockService($this->twig);
        $blockContext = $this->getBlockContext($blockService);

        $this->assertSettings([
            'url'            => null,
            'class'          => null,
            'services'       => ['twitter', 'facebook', 'googleplus'],
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'template'       => '@NucleosShariff/Block/block_shariff.html.twig',
        ], $blockContext);
    }

    public function testExecute(): void
    {
        $block = new Block();

        $blockContext = new BlockContext(
            $block,
            [
                'url'         => null,
                'class'       => null,
                'services'    => ['twitter', 'facebook', 'googleplus'],
                'theme'       => 'standard',
                'orientation' => 'horizontal',
                'template'    => '@NucleosShariff/Block/block_shariff.html.twig',
            ]
        );

        $response = new Response();

        $this->twig->expects(static::once())->method('render')
            ->with(
                '@NucleosShariff/Block/block_shariff.html.twig',
                [
                    'context'  => $blockContext,
                    'settings' => $blockContext->getSettings(),
                    'block'    => $blockContext->getBlock(),
                ]
            )
            ->willReturn('TWIG_CONTENT')
        ;

        $blockService = new ShariffShareBlockService($this->twig);

        static::assertSame($response, $blockService->execute($blockContext, $response));
        static::assertSame('TWIG_CONTENT', $response->getContent());
    }

    public function testExecuteWithNullTemplate(): void
    {
        $this->expectException(LogicException::class);
        $this->expectExceptionMessage('Cannot render block without template');

        $block = new Block();

        $blockContext = new BlockContext($block, [
            'template'    => null,
        ]);

        $response = new Response();

        $blockService = new ShariffShareBlockService($this->twig);
        $blockService->execute($blockContext, $response);
    }

    public function testGetMetadata(): void
    {
        $blockService = new ShariffShareBlockService($this->twig);

        $metadata = $blockService->getMetadata();

        static::assertSame('nucleos_shariff.block.share', $metadata->getTitle());
        static::assertNull($metadata->getImage());
        static::assertSame('NucleosShariffBundle', $metadata->getDomain());
        static::assertSame([
            'class' => 'fa fa-share-square-o',
        ], $metadata->getOptions());
    }

    public function testConfigureEditForm(): void
    {
        $blockService = new ShariffShareBlockService($this->twig);

        $block = new Block();

        $formMapper = $this->createMock(FormMapper::class);
        $formMapper->expects(static::once())->method('add');

        $blockService->configureEditForm($formMapper, $block);
    }
}
