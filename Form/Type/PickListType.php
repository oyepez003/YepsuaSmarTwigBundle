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

class PickListType extends WidgetType {
  
    public function getParent()
    {
        return 'choice';
    }
  
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ui_picklist';
    }
}