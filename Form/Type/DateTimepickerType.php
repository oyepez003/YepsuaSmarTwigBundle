<?php

/*
 * This file is part of the YepsuaSmarTwigBundle.
 *
 * (c) Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yepsua\SmarTwigBundle\Form\Type;

class DateTimepickerType extends DatepickerType {
  
    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'ui_datepicker';
    }
    
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ui_date_timepicker';
    }
}