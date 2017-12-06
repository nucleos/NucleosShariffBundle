<?php

declare(strict_types=1);

/*
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Block\Service;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\AbstractAdminBlockService;
use Sonata\BlockBundle\Model\BlockInterface;
use Sonata\CoreBundle\Form\Type\ImmutableArrayType;
use Sonata\CoreBundle\Model\Metadata;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ShariffShareBlockService extends AbstractAdminBlockService
{
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $parameters = [
            'context'  => $blockContext,
            'settings' => $blockContext->getSettings(),
            'block'    => $blockContext->getBlock(),
        ];

        return $this->renderResponse($blockContext->getTemplate(), $parameters, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block): void
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
                        'form.choice_flattr'      => 'flattr',
                        'form.choice_pinterest'   => 'pinterest',
                        'form.choice_xing'        => 'xing',
                        'form.choice_mail'        => 'mail',
                    ],
                    'choices_as_values' => true,
                    'required'          => false,
                    'multiple'          => true,
                ]],
                ['theme', ChoiceType::class, [
                    'label'   => 'form.label_theme',
                    'choices' => [
                        'standard' => 'standard',
                        'grey'     => 'grey',
                        'white'    => 'white',
                    ],
                ]],
                ['orientation', ChoiceType::class, [
                    'label'   => 'form.label_orientation',
                    'choices' => [
                        'form.choice_vertical'   => 'vertical',
                        'form.choice_horizontal' => 'horizontal',
                    ],
                    'choices_as_values' => true,
                ]],
                ['flattrUser', TextType::class, [
                    'label'    => 'form.label_flattr_user',
                    'required' => false,
                ]],
                ['flattrCategory', TextType::class, [
                    'label'    => 'form.label_flattr_category',
                    'required' => false,
                ]],
            ],
            'translation_domain' => 'Core23ShariffBundle',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'url'            => null,
            'class'          => '',
            'services'       => ['twitter', 'facebook', 'googleplus'],
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'flattrUser'     => null,
            'flattrCategory' => null,
            'template'       => 'Core23ShariffBundle:Block:block_shariff.html.twig',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getJavascripts($media)
    {
        return [
            '/assets/javascript/shariff.js',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getStylesheets($media)
    {
        return [
            '/assets/stylesheet/shariff.css',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockMetadata($code = null)
    {
        return new Metadata($this->getName(), $code ?? $this->getName(), false, 'Core23ShariffBundle', [
            'class' => 'fa fa-share-square-o',
        ]);
    }
}
