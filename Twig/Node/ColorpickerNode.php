<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class ColorpickerNode extends SimpleNode {    

  protected $inline;

  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setIsPlugin(true);
  }
  

  public function configureCallableMethods(){
    return array(
      'inline' => array('method' => '_flat'),
      'output' => array('method' => 'returnHEXValueIn'),   
      'outputMap' => array('method' => 'returnAllValuesIn'),
      'for' => array('method' => 'in'),
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
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('div','input');
  }
  
  public function compileEndWidget(Twig_Compiler $compiler){
    return false;
  }

  public function getWidgetName(){
    return 'colorpicker';
  }

  public function getPluginName() {
    return 'jqColorPicker';
  }   
  
  public function isInline() {
    return $this->inline;
  }

  public function setInline($inline) {
    $this->inline = $inline;
  }
}