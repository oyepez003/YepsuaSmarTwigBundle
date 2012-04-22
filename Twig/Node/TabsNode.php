<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;
use \Twig_Node_Expression_Constant;

/**
 * 
 */
class TabsNode extends ComplexNode {
    
    protected $scrollable;
          
    public function preCompileWidget(Twig_Compiler $compiler){
      $this->setScrollable(false);
      if($this->getNode('values')->hasNode('scrollable')
         && $this->getNodeValue('scrollable')){
         $this->setScrollable(true);
         $this->removePropertie('scrollable');
      }
    }
    
    public function postCompileWidget(Twig_Compiler $compiler){
      if($this->isScrollable()){
        $this->compileScrollableTab($compiler);
      }   
    }
        
    public function compileWidgetContents(Twig_Compiler $compiler){
      $compiler->indent();
        $compiler->write(sprintf('echo %s->initHeader();',$this->getVarName()));
        $compiler->raw("\n");
          $compiler->indent();
            $i = 0;
            $tabsAttrs = array();
            while($this->hasNode('tab_values_' . $i)){
              if($this->isIterable()){
                $this->compileIteratorInitSintax($compiler);
                  $compiler->indent();
                    $tabsAttrs[] = $this->compileTab($compiler, $this->getNode('tab_values_'.$i), $i);
                  $compiler->outdent();
                $this->compileIteratorEndSintax($compiler);
              }else{
                $tabsAttrs[] = $this->compileTab($compiler, $this->getNode('tab_values_'.$i), $i);
              }
              $i++;
            }
          $compiler->outdent();
        $compiler->write(sprintf('echo %s->endHeader();',$this->getVarName()));
        $compiler->raw("\n");
        if($this->isIterable()){
          $this->compileIteratorInitSintax($compiler);
            $compiler->indent();
              $this->compileTabContents($compiler, $tabsAttrs);
            $compiler->outdent();
          $this->compileIteratorEndSintax($compiler, $this->isValidateEmpty());
        }else{
          $this->compileTabContents($compiler, $tabsAttrs);
        }
        $compiler->raw("\n");
      $compiler->outdent();
    }
    
    private function compileTabContents(Twig_Compiler $compiler, $tabsAttr){
      $contextKey = ' . $context[\'_key\']';
      foreach($this->getContent() as $index => $content){
        $attrs = $tabsAttr[$index];
        if(isset($attrs['id'])){
          if(isset($attrs['rendered'])){
            $this->compileIfRendered($compiler, $attrs['rendered'], true);
          }
            $id = $attrs['id'];
            if($this->isIterable()){
             $compiler->write(sprintf('echo %s->initTabContent("%s" %s',$this->getVarName(),$id,$contextKey));
            }else{
              $compiler->write(sprintf('echo %s->initTabContent("%s"',$this->getVarName(),$id));
            }
            $compiler->raw(",");
            $tabNode = $this->getNode('tab_values_' . $index);
            $this->compileStandardHtmlProperties($compiler, $tabNode);
            $compiler->raw(sprintf(");\n"));
            $compiler->indent();
              $compiler->indent();
                $compiler->subcompile($content,true);
              $compiler->outdent();
            $compiler->outdent();
            $compiler->write(sprintf('echo %s->endTabContent();',$this->getVarName()));
            $compiler->raw("\n");
          if(isset($attrs['rendered'])){
            $this->compileEndIf($compiler);
          }
        }
      }
    }
    
    private function compileTab(Twig_Compiler $compiler, $node, $index){
      $tabAttrs = array();
      if(!$node->hasNode('label')){
        $node = new Twig_Node_Expression_Constant('&nbsp;', $this->lineno);
        $node->setNode('label', $node);
      }
      $contextKey = ' . $context[\'_key\']';
      
      if($node->hasNode('rendered')){
        $compiler->write("if(");
        $compiler->indent();
        $compiler->subcompile($node->getNode('rendered'), true);
        $compiler->raw("){\n");
        $compiler->write($this->replaceIndexVar('if(isset($context[\'%INDEX_VAR%\'][\'renderedIndex\']))++$context[\'%INDEX_VAR%\'][\'renderedIndex\'];'));
        $compiler->raw("\n");
      }
      
      $compiler->write(sprintf('echo %s->tab(', $this->getVarName()));
      $compiler->subcompile($node->getNode('label'), true);
      $compiler->raw(",");
      if($node->hasNode('href')){
        $compiler->subcompile($node->getNode('href'), true);
      }else{
        if(!$node->hasNode('id')){
        $id = sprintf('%sTab%s',$this->getId(),$index);
        $tabAttrs['id'] = $id;
        $compiler->string('#'.$id);
        if($this->isIterable()){
          $compiler->raw($contextKey);
        }
        }else{
          $id = $node->getNode('id')->getAttribute('value');
          $tabAttrs['id'] = $id;
          $this->prependValueInNode('id', '#', 'tab_values_' . $index);
          $compiler->subcompile($node->getNode('id'), true);
        }
      }
      
      $compiler->raw(",");
      if(!$node->hasNode('closeable')){
        $compiler->raw('false');
      }else{
        $compiler->subcompile($node->getNode('closeable'), true);
      }
      $compiler->raw(",");
      if(!$node->hasNode('headerHtmlProperties')){
        $compiler->raw('""');
        $tabAttrs['headerHtmlProperties'] = new Twig_Node_Expression_Constant('', $this->lineno);
      }else{
        $compiler->subcompile($node->getNode('headerHtmlProperties'), true);
      }
      if($node->hasNode('rendered')){
        $tabAttrs['rendered'] = $node->getNode('rendered');
      }
      $compiler->raw(");\n");
      if($node->hasNode('rendered')){
        $compiler->outdent();
        $compiler->write('}');
        $compiler->raw("\n");
      }
      return $tabAttrs;
    }
    
    private function compileScrollableTab(Twig_Compiler $compiler){
      $compiler->write(sprintf('echo %s->scrollabletabs("%s")',$this->getVarName(),$this->getSelector()));
      $compiler->indent();
      $compiler->indent();
      $callableMethods = array('animationSpeed' => array('method' => '_animationSpeed'),
        'loadLastTab' => array('method' => '_loadLastTab'),
        'resizable'    => array('method' => '_resizable'),
        'resizeHandles' => array('method' => '_resizeHandles'),
        'easing' => array('method' => '_easing')
      );
      $this->compileCallableMethods($compiler,$callableMethods);
      $compiler->write(sprintf('%s;',$this->getExecuteSintax()));
      $compiler->outdent();
      $compiler->outdent();
      $compiler->raw("\n");
    }
    
    public function isScrollable() {
      return $this->scrollable;
    }

    public function setScrollable($scrollable) {
      $this->scrollable = $scrollable;
    }
    
    public function isIterableNode(){
      return true;
    }
    
    public function getWidgetName(){
      return 'tabs';
    }
}