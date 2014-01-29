<?php

namespace Victoire\ArticleListBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\CmsBundle\Form\EntityProxyFormType;
use Victoire\CmsBundle\Form\WidgetType;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;


/**
 * WidgetArticleList form type
 */
class WidgetArticleListType extends WidgetType
{

    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $noValidationClosure = function (QueryInterface $filterQuery, $field, $values) {
                return false;
        };

        $builder
            ->add('title', 'filter_text', array(
                'condition_pattern' => FilterOperands::STRING_BOTH,
                'label'             => 'widget.articlelist.form.type.title.label'))
            ->add('maxResults', 'integer', array(
                'apply_filter' => $noValidationClosure,
                'label'        => 'widget.articlelist.form.type.maxResults.label',
            ))
            ->add('globalLinkTitle', null, array(
                'apply_filter' => $noValidationClosure,
                'label'        => 'widget.articlelist.form.type.linkTitle.label',
            ))
            ->add('globalLinkUrl', null, array(
                'apply_filter' => $noValidationClosure,
                'label'        => 'widget.articlelist.form.type.linkUrl.label',
            ))
            ->add('globalLinkLabel', null, array(
                'apply_filter' => $noValidationClosure,
                'label'        => 'widget.articlelist.form.type.linkLabel.label',
            ));
    }

    /**
     * get form name
     */
    public function getName()
    {
        return 'appventus_victoirecmsbundle_widgetarticlelisttype';
    }

    /**
     * bind form to WidgetArticleList entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'data_class'        => 'Victoire\ArticleListBundle\Entity\WidgetArticleList',
            'validation_groups' => array('filtering'), // avoid NotBlank() constraint-related message
            'widget'             => 'articlelist',
            'translation_domain' => 'victoire'
        ));
    }
}