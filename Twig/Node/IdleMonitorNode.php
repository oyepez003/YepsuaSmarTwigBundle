<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class IdleMonitorNode extends SimpleNode {    
    
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setOnlyJsS(true);
    $this->setIsPlugin(true);
    if($this->getNode('values')->hasNode('for')){
      $this->setInSelector(true);
    }else{
      $this->setInSelector(false);
    }
  }

  public function configureCallableMethods(){
    return array(
      'for' => array('method' => 'in'),
      'sleep' => array('method' => '_timeout'),
      'onActive' => array('method' => '_onActive'),  
      'onIdle' => array('method' => '_onIdle'),
    );
  }

  public function getWidgetName(){
    return 'monitor';
  }

  public function getPluginName() {
    return 'jqMonitor';
  }
}