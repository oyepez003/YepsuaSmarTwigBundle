<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

class LayoutNode extends SimpleNode {

  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setIsPlugin(true);
    if($this->getNode('values')->hasNode('region')){
      $this->setOnlyHTML(true);
    }
  }

  public function compileInitWidget(Twig_Compiler $compiler){
    if(!$this->getNode('values')->hasNode('region')){
      parent::compileInitWidget($compiler);
    }else{
      $compiler->write(sprintf('echo %s->initLayout(',$this->getVarName()));
      $compiler->subcompile($this->getNode('values')->getNode('region'));
      $compiler->raw(',');
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
    }
  }

  public function compileEndWidget(Twig_Compiler $compiler){
    if(!$this->getNode('values')->hasNode('region')){
      parent::compileEndWidget($compiler);
    }else{
      $compiler->write(sprintf('echo %s->endLayout();',$this->getVarName()));
    }
  }

  public function getWidgetName(){
    return 'layout';
  }

  public function getPluginName() {
    return 'jLayout';
  }
}