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

use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DatepickerType extends WidgetType {
  
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);
        
        $resolver->setDefaults(array(
            'widget'         => 'single_text',
            'widget_options'  => array(
              'showButtonPanel' => true,
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
    public function getParent()
    {
        return 'date';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ui_datepicker';
    }
}