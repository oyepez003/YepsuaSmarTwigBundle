<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class RCNode extends SimpleNode {
  
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setOnlyJsS(true);
    $this->setInSelector(false);
    if($this->getNode('values')->hasNode('name')){
      $this->getNode('values')->setNode('widgetVar',$this->getNode('values')->getNode('name'));
      $this->getNode('values')->removeAttribute('name');
    }
  }

  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    $compiler->raw('->remoteCommand(');
    if($this->getNode('values')->hasNode('proccess')){
      $compiler->subcompile($this->getNode('values')->getNode('proccess'));
      $this->removeAttribute('proccess');
    }else{
       $compiler->write('null');
    }
    if($this->getNode('values')->hasNode('update')){
      $compiler->write(',');
      $compiler->subcompile($this->getNode('values')->getNode('update'));
      $this->removeAttribute('update');
    }
    $compiler->raw(')->setEmbebedFunction(true)');
  }

  public function getWidgetName(){
    return 'jqueryCore';
  }
    
  public function getOptionsToSkip(){
    return array('proccess','update');
  }
}