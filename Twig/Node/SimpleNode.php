<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;

class SimpleNode extends CommonNode{
  
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct(array('values' => $values), array('names' => $names), $lineno, $tag);
    }
    
    /**
     * Compiles the node to PHP.
     *
     * @param Twig_Compiler A Twig_Compiler instance
     */
    public function compileWidget(Twig_Compiler $compiler){            
      $compiler->addDebugInfo($this);
      $this->compileOptions($compiler);
      $this->compileExtension($compiler);
      if(!$this->isOnlyJsS()){
        $this->compileInitWidget($compiler);
        $this->compileHtmlProperties($compiler);
        $this->compileWidgetContents($compiler);
        $this->compileEndWidget($compiler);
      }
      if(!$this->isOnlyHTML()){
        if($this->isBuiltByListener()){
          $this->compileListener($compiler);
        }
        $this->compileBuilder($compiler);
        if($this->isExec()){
          $this->compileCallableMethods($compiler);
          $this->compileExecute($compiler);
        }
      }
    }
    
    public function compileWidgetContents(Twig_Compiler $compiler){
      if($this->getContent() !== null){
        $compiler->indent();
          $compiler->subcompile($this->getContent(),true);
        $compiler->outdent();
      }
    }
}