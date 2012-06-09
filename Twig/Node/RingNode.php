<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class RingNode extends SimpleNode {
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setIsPlugin(true);
    }
    
    public function getWidgetName(){
      return 'ring';
    }
    
    public function getPluginName() {
      return 'jqRing';
    }
}