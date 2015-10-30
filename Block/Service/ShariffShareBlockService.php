<?php

/*
 * This file is part of the ni-ju-san CMS.
 *
 * (c) Christian Gripp <mail@core23.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Core23\ShariffBundle\Block\Service;

use Sonata\AdminBundle\Form\FormMapper;
use Sonata\BlockBundle\Block\BaseBlockService;
use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Model\BlockInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShariffShareBlockService extends BaseBlockService
{
    /**
     * {@inheritdoc}
     */
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $parameters = array(
            'context'    => $blockContext,
            'settings'   => $blockContext->getSettings(),
            'block'      => $blockContext->getBlock(),
        );

        return $this->renderResponse($blockContext->getTemplate(), $parameters, $response);
    }

    /**
     * {@inheritdoc}
     */
    public function buildEditForm(FormMapper $formMapper, BlockInterface $block)
    {
        $formMapper->add(
            'settings',
            'sonata_type_immutable_array',
            array(
                'keys'               => array(
                    array('url', 'text', array('required'   => false, 'label' => 'form.label_url')),
                    array('class', 'text', array('required' => false, 'label' => 'form.label_class')),
                    array('services', 'choice', array(
                        'choices'  => array(
                            'twitter'     => 'form.choice_twitter',
                            'facebook'    => 'form.choice_facebook',
                            'googleplus'  => 'form.choice_googleplus',
                            'linkedin'    => 'form.choice_linkedin',
                            'reddit'      => 'form.choice_reddit',
                            'stumbleupon' => 'form.choice_stumbleupon',
                            'flattr'      => 'form.choice_flattr',
                            'pinterest'   => 'form.choice_pinterest',
                            'mail'        => 'form.choice_mail',
                        ),
                        'required' => false,
                        'multiple' => true,
                        'label'    => 'form.label_services',
                    )),
                    array('theme', 'choice', array(
                        'choices' => array(
                            'standard' => 'standard',
                            'grey'     => 'grey',
                            'white'    => 'white',
                        ),
                        'label'   => 'form.label_theme',
                    )),
                    array('orientation', 'choice', array(
                        'choices' => array(
                            'vertical'   => 'form.choice_vertical',
                            'horizontal' => 'form.choice_horizontal',
                        ),
                        'label'   => 'form.label_orientation',
                    )),
                    array('flattrUser', 'text', array('required'     => false, 'label' => 'form.label_flattr_user')),
                    array('flattrCategory', 'text', array('required' => false, 'label' => 'form.label_flattr_category')),
                ),
                'translation_domain' => 'Core23ShariffBundle',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureSettings(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'url'            => null,
                'class'          => '',
                'services'       => array('twitter', 'facebook', 'googleplus'),
                'theme'          => 'standard',
                'orientation'    => 'horizontal',
                'flattrUser'     => null,
                'flattrCategory' => null,
                'template'       => 'Core23ShariffBundle:Block:block_shariff.html.twig',
            )
        );
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
}
