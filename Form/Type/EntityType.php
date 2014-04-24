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

class EntityType extends WidgetType {
  
    public function getParent()
    {
        return 'entity';
    }
  
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ui_entity';
    }
}