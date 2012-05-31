<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class OptionItemNode extends SimpleNode {
  
  
  /**
  * Compiles the node to PHP.
  *
  * @param Twig_Compiler A Twig_Compiler instance
  */
  public function compileWidget(Twig_Compiler $compiler){            
    $compiler->addDebugInfo($this);
    $this->compileExtension($compiler);
    //if($this->getNode('values')->getNode('value') instanceof \Twig_Node_Expression_GetAttr ){
    if ($this->isIterable()) {
      $this->compileIteratorInitSintax($compiler);
        $this->compileInitWidget($compiler);
        $this->compileHtmlProperties($compiler);
        $this->buildId();
      $this->compileIteratorEndSintax($compiler, $this->isValidateEmpty());
    }else{
      $this->compileInitWidget($compiler);
      $this->compileHtmlProperties($compiler);
    }    
  }
  
  public function compileHtmlProperties(Twig_Compiler $compiler, $args = array()){
    $this->compileStandardHtmlProperties($compiler);
    $compiler->write(sprintf(',"%s"',$this->getTagName()));
    
    if($this->getNode('values')->hasNode('label')){
       $compiler->write(',');
       $compiler->subcompile($this->getNode('values')->getNode('label'));
    }
    
    $compiler->write(');');
    $compiler->raw("\n");
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('optionWithoutLabel');
  }
    
  public function getWidgetName(){
    return 'html';
  }
  
  public function getTagName(){
    return 'option';
  }
  
  public function getSuffixId(){
    return $this->getTagName();
  }  
  
  public function isIterableNode(){
    return true;
  }
}