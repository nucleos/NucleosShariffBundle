<?php

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
        $parameters = array(
            'context'  => $blockContext,
            'settings' => $blockContext->getSettings(),
            'block'    => $blockContext->getBlock(),
        );

        return $this->renderResponse($blockContext->getTemplate(), $parameters, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add('settings', ImmutableArrayType::class, array(
            'keys' => array(
                array('url', TextType::class, array(
                    'label'    => 'form.label_url',
                    'required' => false,
                )),
                array('class', TextType::class, array(
                    'label'    => 'form.label_class',
                    'required' => false,
                )),
                array('services', ChoiceType::class, array(
                    'label'   => 'form.label_services',
                    'choices' => array(
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
                    ),
                    'choices_as_values' => true,
                    'required'          => false,
                    'multiple'          => true,
                )),
                array('theme', ChoiceType::class, array(
                    'label'   => 'form.label_theme',
                    'choices' => array(
                        'standard' => 'standard',
                        'grey'     => 'grey',
                        'white'    => 'white',
                    ),
                )),
                array('orientation', ChoiceType::class, array(
                    'label'   => 'form.label_orientation',
                    'choices' => array(
                        'form.choice_vertical'   => 'vertical',
                        'form.choice_horizontal' => 'horizontal',
                    ),
                    'choices_as_values' => true,
                )),
                array('flattrUser', TextType::class, array(
                    'label'    => 'form.label_flattr_user',
                    'required' => false,
                )),
                array('flattrCategory', TextType::class, array(
                    'label'    => 'form.label_flattr_category',
                    'required' => false,
                )),
            ),
            'translation_domain' => 'Core23ShariffBundle',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'url'            => null,
            'class'          => '',
            'services'       => array('twitter', 'facebook', 'googleplus'),
            'theme'          => 'standard',
            'orientation'    => 'horizontal',
            'flattrUser'     => null,
            'flattrCategory' => null,
            'template'       => 'Core23ShariffBundle:Block:block_shariff.html.twig',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getJavascripts($media)
    {
        return array(
            '/assets/js/shariff.js',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getStylesheets($media)
    {
        return array(
            '/assets/css/shariff.css',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockMetadata($code = null)
    {
        return new Metadata($this->getName(), $code ?? $this->getName(), false, 'Core23ShariffBundle', array(
            'class' => 'fa fa-share-square-o',
        ));
    }
}
