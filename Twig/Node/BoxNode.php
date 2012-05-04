<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class BoxNode extends SimpleNode {    
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setOnlyJsS(true);
      $this->setIsPlugin(true);
    }
  
    public function configureCallableMethods(){
      return array(
        'for' => array('method' => 'in'),
        'toolbar' => array('method' => '_withButtons'),
        'errorMessage' => array('method' => '_errorMsg'),
        'nextTitle' => array('method' => '_nextTitle'),
        'prevTitle' => array('method' => '_prevTitle'),
        'closeTitle' => array('method' => '_closeTitle'),
      );
    }
            
    public function getWidgetName(){
      return 'box';
    }
    
    public function getPluginName() {
      return 'jqBox';
    }
}