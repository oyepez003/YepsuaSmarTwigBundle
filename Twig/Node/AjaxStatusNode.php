<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class AjaxStatusNode extends SimpleNode {    
  
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setOnlyJsS(true);
    $this->setExec(false);
    if($this->getNode('values')->hasNode('name')){
      $this->getNode('values')->setNode('widgetVar',$this->getNode('values')->getNode('name'));
      $this->getNode('values')->removeAttribute('name');
    }
  }
  
  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    $compiler->raw('->executeAjaxStatus(');
    $options = array('for','onstart','onsend','onsuccess','oncomplete','onerror','onstop');
    foreach($options as $option){
      if($this->getNode('values')->hasNode($option)){
        $compiler->subcompile($this->getNode('values')->getNode($option));
        $this->removeAttribute($option);
      }else{
         $compiler->write('null');
      }
      if($option !== 'onstop'){
        $compiler->write(',');
      }
    }
    $compiler->write(')');
  }
  
  public function getWidgetName(){
    return 'jqueryCore';
  }
}