<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class AjaxFormNode extends SimpleNode {    
    
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setIsPlugin(true);
  }

  public function configureCallableMethods(){
    return array(
      'update' => array('method' => '_target'),
    );
  }
  
  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('withValidation') && $this->getNodeValue('withValidation')){
      $compiler->raw('->ajaxSubmit()');
    }else{
      parent::compileBuilderFuntcionName($compiler);
    }
  }

  public function getWidgetName(){
    return 'ajaxForm';
  }

  public function getPluginName() {
    return 'jqForm';
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('form');
  }
}