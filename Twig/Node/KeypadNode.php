<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class KeypadNode extends SimpleNode {    

  protected $inline;

  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setIsPlugin(true);
  }
  

  public function configureCallableMethods(){
    return array(
      'for' => array('method' => 'in'),
      'layout' => array('method' => '_customLayout'),
      'layoutVars' => array('method' => '_customLayoutVars'),
      'showOnButton' => array('method' => '_showOnButton'),
    );
  }
  
  public function compileWidget(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('inline')){
      if($this->getNodeValue('inline')){
        $this->setInline(true);
      }
    }
    parent::compileWidget($compiler);
  }
  
  public function compileInitWidget(Twig_Compiler $compiler){
    if($this->isInline()){
      $compiler->write(sprintf('echo %s->inline(',$this->getVarName()));
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
    }else{
      $compiler->write(sprintf('echo %s->input(',$this->getVarName()));
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
    }
  }
  
  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('qwerty') && $this->getNodeValue('qwerty')){
        $compiler->raw('->qwerty()');
    }elseif($this->getNode('values')->hasNode('alphabetic') && $this->getNodeValue('alphabetic')){
        $compiler->raw('->alphabetic()');
    }
    else{
      parent::compileBuilderFuntcionName($compiler);
    }
  }
  
  public function compileEndWidget(Twig_Compiler $compiler){
    return false;
  }

  public function getWidgetName(){
    return 'keypad';
  }

  public function getPluginName() {
    return 'jqKeypad';
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('div','input');
  }
  
  public function isInline() {
    return $this->inline;
  }

  public function setInline($inline) {
    $this->inline = $inline;
  }
}