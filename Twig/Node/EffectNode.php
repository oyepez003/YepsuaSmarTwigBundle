<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class EffectNode extends SimpleNode {    
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setOnlyJsS(true);
    }
  
    public function configureCallableMethods(){
      return array(
        'for' => array('method' => 'in'),
        'effect' => array('method' => 'effectName'),
        'options' => array('method' => 'options'),
        'properties' => array('method' => 'properties'),
        'duration' => array('method' => 'duration'),
        'callback' => array('method' => 'callback'),
      );
    }
    
    
    
    
    public function compileBuilderFuntcionName(Twig_Compiler $compiler){
      if($this->getNode('values')->hasNode('mode')){
        $type = $this->getNodeValue('mode');
        if($type === 'hide'){
          $compiler->raw('->hide()');
        }
        if($type === 'animate'){
          $compiler->raw('->animate()');
        }
        if($type === 'show'){
          $compiler->raw('->show()');
        }
      }else{
        $compiler->raw('->effect()');
      }
    }
        
    public function getWidgetName(){
      return 'effect';
    }
}