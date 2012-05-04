<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class ButtonNode extends SimpleNode {    
    
  protected $buttonset;

  public function __construct($names, $values, $lineno, $tag = null, $isButtonset = false) {
    $this->setButtonset($isButtonset);
    parent::__construct($names, $values, $lineno, $tag);
  }

  public function isButtonset() {
    return $this->buttonset;
  }

  public function setButtonset($buttonset) {
    $this->buttonset = $buttonset;
  }

  public function preCompileWidget(Twig_Compiler $compiler){
    if(!$this->isButtonset()){
      if(!$this->getNode('values')->hasNode('type')){
        $this->addExpressionConstantNode('type','button', $this->lineno);
      }
      if($this->getNode('values')->hasNode('icons')){
        $this->addExpressionConstantNode('type','icon', $this->lineno);
      }
      if(!$this->getNode('values')->hasNode('label')){
        $this->addExpressionConstantNode('text',false, $this->lineno);
      }
      $this->setNode('typeAux',$this->getNode('values')->getNode('type'));
    }
  }
    
  public function compileInitWidget(Twig_Compiler $compiler){
    if($this->isButtonset()){
      $compiler->write(sprintf('echo %s->initButtonset(',$this->getVarName()));
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
    }else{
      $compiler->write(sprintf('echo %s->initButton(',$this->getVarName()));
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
    }
  }

  public function compileEndWidget(Twig_Compiler $compiler){
    if($this->isButtonset()){
      $compiler->write(sprintf('echo %s->endButtonset();',$this->getVarName()));
      $compiler->raw("\n");
    }else{
      parent::compileEndWidget($compiler);
    }
  }
  
  public function compileHtmlProperties(Twig_Compiler $compiler, $args = array()){
    $this->compileStandardHtmlProperties($compiler);
    if($this->hasNode('typeAux')){
      $compiler->raw(',');
      $compiler->subcompile($this->getNode('typeAux'));
    }
    if($this->getNode('values')->hasNode('label')){
      $compiler->raw(',');
      $compiler->subcompile($this->getNode('values')->getNode('label'));
    }
    $compiler->write(');');
    $compiler->raw("\n");
  }
  
  public function compileBuilder(Twig_Compiler $compiler){
    if($this->isButtonset()){
      $compiler->write(sprintf('echo %s->buildButtonset()',$this->getVarName()));
      $compiler->indent();
      $compiler->indent();
      $compiler->write("\n");
      $compiler->write('->in(');
      $this->compileSelector($compiler);
      $compiler->raw(')');
      $compiler->write("\n");
      $compiler->write(sprintf("->addOptions(%s)\n",$this->getOptionsVarName()));
    }else{
      parent::compileBuilder($compiler);
    }
  }
  
  public function getWidgetName(){
    return 'button';
  }

  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('button','a');
  }
}