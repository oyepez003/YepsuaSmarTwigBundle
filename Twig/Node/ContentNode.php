<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class ContentNode extends SimpleNode {
  
  
  /**
  * Compiles the node to PHP.
  *
  * @param Twig_Compiler A Twig_Compiler instance
  */
  public function compileWidget(Twig_Compiler $compiler){            
    $compiler->addDebugInfo($this);
    $this->compileExtension($compiler);
    //if($this->getNode('values')->getNode('value') instanceof \Twig_Node_Expression_GetAttr ){
    if($this->getNode('values')->hasNode('type')){
      $type = $this->getNodeValue('type');
      if($type === 'footer_panel' || $type === 'panel_footer'){
        if($this->getNode('values')->hasNode('class')){
          $this->prependValueInNode(
            'class', 
            'ui-panel-footer ui-widget-content ui-helper-clearfix '
          );
        }else{
          $this->addExpressionConstantNode(
            'class', 
            'ui-panel-footer ui-widget-content ui-helper-clearfix', 
            $this->lineno
          );
        }
      }
    }
    
    if ($this->isIterable()) {
      $this->compileIteratorInitSintax($compiler);
        $this->compileInitWidget($compiler);
        $this->compileHtmlProperties($compiler);
        $this->buildId();
        $this->compileWidgetContents($compiler);
        $this->compileEndWidget($compiler);
      $this->compileIteratorEndSintax($compiler, $this->isValidateEmpty());
    }else{
      $this->compileInitWidget($compiler);
      $this->compileHtmlProperties($compiler);
      $this->compileWidgetContents($compiler);
      $this->compileEndWidget($compiler);
    }    
  }
  
  public function compileEndWidget(Twig_Compiler $compiler){
    $compiler->write(sprintf('echo %s->endWidget("%s");',$this->getVarName(),$this->getTagName()));
    $compiler->raw("\n");
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
  
  public function getWidgetName(){
    return 'html';
  }
  
  public function getTagName(){
    return 'div';
  }
  
  public function getSuffixId(){
    return $this->getTagName();
  }  
  
  public function isIterableNode(){
    return true;
  }
}