<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;
use \Twig_Node_Expression_Constant;

/**
 * 
 */
class AccordionNode extends ComplexNode {
        
    public function compileWidgetContents(Twig_Compiler $compiler){
      $compiler->indent();
        $i = 0;
        while ($this->hasNode('tab_values_' . $i)) {
          if ($this->isIterable()) {
            $this->compileIteratorInitSintax($compiler);
              $compiler->indent();
                $this->compileSections($compiler, $this->getNode('tab_values_' . $i), $i);
              $compiler->outdent();
            $this->compileIteratorEndSintax($compiler, $this->isValidateEmpty());
          } else {
            $this->compileSections($compiler, $this->getNode('tab_values_' . $i), $i);
          }
          $i++;
        }
      $compiler->outdent();
    }
    
    private function compileSections(\Twig_Compiler $compiler, $node, $index){
      $contents = $this->getContent();
      if(isset($contents[$index])){
        if($node->hasNode('rendered')){
          $this->compileIfRendered($compiler, $node->getNode('rendered'), true);
        }
          $content = $contents[$index];
          if(!$node->hasNode('label')){
            $node = new Twig_Node_Expression_Constant('&nbsp;', $this->lineno);
            $node->setNode('label', $node);
          }
          $compiler->write(sprintf('echo %s->initSection(', $this->getVarName()));
          $compiler->subcompile($node->getNode('label'));
          $compiler->raw(",");
          $tabNode = $this->getNode('tab_values_' . $index);
          $this->compileStandardHtmlProperties($compiler, $tabNode);        
          $compiler->raw(");\n");
          $compiler->indent();
            $compiler->indent();
              $compiler->subcompile($content,true);
            $compiler->outdent();
          $compiler->outdent();
          $compiler->write(sprintf('echo %s->endSection();',$this->getVarName()));
          $compiler->raw("\n");
        if($node->hasNode('rendered')){
          $this->compileEndIf($compiler);
        }
      }
    }
    
    public function isIterableNode(){
      return true;
    }

    public function getWidgetName(){
      return 'accordion';
    }
}