<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class CycleNode extends SimpleNode {
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setIsPlugin(true);
    }
    
    public function getWidgetName(){
      return 'cycle';
    }
    
    public function getPluginName() {
      return 'jqCycle';
    }
}