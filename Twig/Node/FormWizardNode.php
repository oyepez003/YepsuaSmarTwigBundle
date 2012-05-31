<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class FormWizardNode extends SimpleNode {    
    
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setIsPlugin(true);
    $this->setOnlyHTML($this->getNode('values')->hasNode('step'));
  }

  public function configureCallableMethods(){
    return array(
      'withAjaxForm' => array('method' => '_formPluginEnabled'),
      'withValidations' => array('method' => '_validationEnabled'),
      'withHistory' => array('method' => '_historyEnabled'),
      'withoutStyles' => array('method' => '_disableUIStyles'),
    );
  }

  public function compileInitWidget(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('step')){
      $compiler->write(sprintf('echo %s->initStep(',$this->getVarName()));
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
      $compiler->subcompile($this->getNode('values')->getNode('step'));
      $compiler->raw(',');
    }else{
      parent::compileInitWidget($compiler);
    }
  }

  public function compileEndWidget(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('step')){
      $compiler->write(sprintf('echo %s->endStep();',$this->getVarName()));
      $compiler->raw("\n");
    }else{
      parent::compileEndWidget($compiler);
    }
  }

  public function getWidgetName(){
    return 'formWizard';
  }

  public function getPluginName() {
    return 'formWizard';
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('form');
  }
}