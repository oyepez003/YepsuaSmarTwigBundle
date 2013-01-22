<?php

/*
 * This file is part of the SmarTwig Bundle.
 *
 * (c) Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yepsua\SmarTwigBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DatepickerType extends DateType {
  
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        
        $resolver->setDefaults(array(
            'widget'         => 'single_text',
            'widget_options'  => array(
              'dateFormat' => 'yy-mm-dd', 
              'changeMonth'=> true, 
              'changeYear'=>  true
            ),
        ));
        
        $resolver->setAllowedValues(array(
            'input'     => array(
                'datetime',
                'string',
                'timestamp',
                'array',
            ),
            'widget'    => array(
                'single_text',
            ),
        ));
        
    }
    
    /**
     * {@inheritdoc}
     */
    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        parent::finishView($view, $form, $options);
        $view->vars['widget_options'] = $options['widget_options'];
    }
    
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ui_datepicker';
    }
}