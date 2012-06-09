<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class BookletNode extends SimpleNode {
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setIsPlugin(true);
    }
    
    public function getWidgetName(){
      return 'booklet';
    }
    
    public function getPluginName() {
      return 'jqBooklet';
    }
}