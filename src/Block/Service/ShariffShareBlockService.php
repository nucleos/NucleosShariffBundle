<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nucleos\ShariffBundle\Block\Service;

use LogicException;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractBlockService;
use Sonata\BlockBundle\Block\Service\EditableBlockService;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Sonata\BlockBundle\Meta\Metadata;
use Sonata\BlockBundle\Meta\MetadataInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\Form\Type\ImmutableArrayType;
use Sonata\Form\Validator\ErrorElement;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShariffShareBlockService extends AbstractBlockService implements EditableBlockService
{
    public function execute(BlockContextInterface $blockContext, ?Response $response = null): Response
    {
        $parameters = [
            'context'  => $blockContext,
            'settings' => $blockContext->getSettings(),
            'block'    => $blockContext->getBlock(),
        ];

        if (!\is_string($blockContext->getTemplate())) {
            throw new LogicException('Cannot render block without template');
        }

        return $this->renderResponse($blockContext->getTemplate(), $parameters, $response);
    }

    public function configureCreateForm(FormMapper $form, BlockInterface $block): void
    {
        $this->configureEditForm($form, $block);
    }

    public function configureEditForm(FormMapper $formMapper, BlockInterface $block): void
    {
        $formMapper->add('settings', ImmutableArrayType::class, [
            'keys' => [
                ['url', TextType::class, [
                    'label'    => 'form.label_url',
                    'required' => false,
                ]],
                ['class', TextType::class, [
                    'label'    => 'form.label_class',
                    'required' => false,
                ]],
                ['services', ChoiceType::class, [
                    'label'   => 'form.label_services',
                    'choices' => [
                        'form.choice_twitter'     => 'twitter',
                        'form.choice_facebook'    => 'facebook',
                        'form.choice_googleplus'  => 'googleplus',
                        'form.choice_addthis'     => 'addthis',
                        'form.choice_linkedin'    => 'linkedin',
                        'form.choice_reddit'      => 'reddit',
                        'form.choice_stumbleupon' => 'stumbleupon',
                        'form.choice_pinterest'   => 'pinterest',
                        'form.choice_xing'        => 'xing',
                        'form.choice_mail'        => 'mail',
                    ],
                    'required' => false,
                    'multiple' => true,
                ]],
                ['theme', ChoiceType::class, [
                    'label'   => 'form.label_theme',
                    'choices' => [
                        'standard' => 'standard',
                        'grey'     => 'grey',
                        'white'    => 'white',
                    ],
                    'choice_translation_domain' => false,
                ]],
                ['orientation', ChoiceType::class, [
                    'label'   => 'form.label_orientation',
                    'choices' => [
                        'form.choice_vertical'   => 'vertical',
                        'form.choice_horizontal' => 'horizontal',
                    ],
                ]],
            ],
            'translation_domain' => 'NucleosShariffBundle',
        ]);
    }

    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'url'            => null,
            'class'          => null,
            'services'       => ['twitter', 'facebook', 'googleplus'],
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'template'       => '@NucleosShariff/Block/block_shariff.html.twig',
        ]);
    }

    public function validate(ErrorElement $errorElement, BlockInterface $block): void
    {
    }

    public function getMetadata(): MetadataInterface
    {
        return new Metadata('nucleos_shariff.block.share', null, null, 'NucleosShariffBundle', [
            'class' => 'fa fa-share-square-o',
        ]);
    }

    public function getName(): string
    {
        return $this->getMetadata()->getTitle();
    }
}
