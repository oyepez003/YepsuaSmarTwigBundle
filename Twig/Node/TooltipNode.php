<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class TooltipNode extends SimpleNode {    
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setOnlyJsS(true);
    }
  
    public function configureCallableMethods(){
      return array(
        'label' => array('method' => '_content'),
        'for' => array('method' => 'in'),
      );
    }
        
    public function getWidgetName(){
      return 'tooltip';
    }
}