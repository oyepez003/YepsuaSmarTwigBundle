<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class ValidationNode extends SimpleNode {    
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setOnlyJsS(true);
      $this->setIsPlugin(true);
    }
  
    public function configureCallableMethods(){
      return array(
        'for' => array('method' => 'in'),
      );
    }
        
    public function getWidgetName(){
      return 'validation';
    }
    
    public function getPluginName() {
      return 'jqValidate';
    }
}