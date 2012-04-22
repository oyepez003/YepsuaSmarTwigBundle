<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

class PanelNode extends SimpleNode {
       
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setOnlyHTML(true);
    }
    
    public function compileHtmlProperties(Twig_Compiler $compiler, $args = array()){
      $this->compileStandardHtmlProperties($compiler);
      $compiler->write(');');
      $compiler->raw("\n");
      if($this->getNode('values')->hasNode('title')){
        $compiler->write(sprintf('echo %s->title(',$this->getVarName()));
        $compiler->subcompile($this->getNode('values')->getNode('title'));     
        if($this->getNode('values')->hasNode('icon')){
          $compiler->raw(',');
          if($this->getNode('values')->hasNode('icon_alignment')){
            $compiler->raw('array(');
          }
          $compiler->subcompile($this->getNode('values')->getNode('icon'));
          if($this->getNode('values')->hasNode('icon_alignment')){
            $compiler->raw(',');
            $compiler->subcompile($this->getNode('values')->getNode('icon_alignment'));
            $compiler->raw(')');
          }
        }
        $compiler->write(');');
        $compiler->raw("\n");
      }
    }
    
    public function noRemovableProperties(){
      return array('title','icon');
    }
    
    public function getWidgetName(){
      return 'panel';
    }
}