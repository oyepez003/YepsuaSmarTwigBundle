<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Compiler;
use \Twig_Node_Expression_Constant;
use \Twig_Node_Expression_Name;

/**
 * 
 */
class DatepickerNode extends SimpleNode {    
    
  protected $timepicker;
  protected $rangepicker;
  protected $dateTimepicker;
  protected $inline;

  public function compileWidget(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('datetime')){
      if($this->getNodeValue('datetime')){
        $this->setDateTimepicker(true);
      }
      $this->getNode('values')->removeNode('datetime');
    }
    
    if($this->getNode('values')->hasNode('time')){
      if($this->getNodeValue('time')){
        if(!$this->getNode('values')->hasNode('ampm')){
          $node = new Twig_Node_Expression_Constant(false, $this->lineno);
          $name = new Twig_Node_Expression_Name('ampm', $this->lineno);
          $this->addNode('ampm',$node, $name);
        }
        $this->setTimepicker(true);
      }
      $this->getNode('values')->removeNode('time');
    }
    if($this->getNode('values')->hasNode('range')){
      if($this->getNodeValue('range')){
        $this->setRangepicker(true);
      }
      $this->getNode('values')->removeNode('range');
    }
    if($this->getNode('values')->hasNode('inline')){
      if($this->getNodeValue('inline')){
        $this->setInline(true);
      }
      $this->getNode('values')->removeNode('inline');
    }
    //print_r($this->getNode('values'));
    //print_r($this->getAttribute('names'));
    parent::compileWidget($compiler);
  }
  
  public function compileInitWidget(Twig_Compiler $compiler){
    if($this->isInline()){
        parent::compileInitWidget($compiler);
    }else{
      $compiler->write(sprintf('echo %s->input(',$this->getVarName()));
      $this->compileWidgetId($compiler);
      $compiler->raw(',');
    }
  }

  public function compileEndWidget(Twig_Compiler $compiler){
    if($this->isInline()){
      parent::compileEndWidget($compiler);
    }
  }
  
  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    if($this->isTimepicker()){
      $compiler->raw('->timepicker()');
    }elseif($this->isRangepicker ()){
      $compiler->raw('->daterangepicker()');   
    }else{
      parent::compileBuilderFuntcionName($compiler);
    }
  }
  
  /*public function compileBuilder(Twig_Compiler $compiler){
    if($this->isTimepicker()){
      $compiler->write(sprintf('echo %s->timepicker()',$this->getVarName()));
      $compiler->indent();
      $compiler->indent();
      $compiler->write("\n");
      $compiler->write('->in(');
      $this->compileSelector($compiler);
      $compiler->raw(')');
      $compiler->write("\n");
      $compiler->write(sprintf("->addOptions(%s)\n",$this->getOptionsVarName()));
    }elseif($this->isRangepicker ()){
        
      }else{
        parent::compileBuilder($compiler);
      }
  }*/

  public function getWidgetName(){
    $name = 'datepicker';
    if($this->isDateTimepicker() || $this->isTimepicker()){
      $name = 'datetimepicker';
    }
    return $name;
  }
  
  public function isInline() {
    return $this->inline;
  }

  public function setInline($inline) {
    $this->inline = $inline;
  }

  public function isTimepicker() {
    return $this->timepicker;
  }

  public function setTimepicker($timepicker) {
    $this->timepicker = $timepicker;
  }
  
  public function isDateTimepicker() {
    return $this->dateTimepicker;
  }

  public function setDateTimepicker($dateTimepicker) {
    $this->dateTimepicker = $dateTimepicker;
  }
  
  public function isRangepicker() {
    return $this->rangepicker;
  }

  public function setRangepicker($rangepicker) {
    $this->rangepicker = $rangepicker;
  }
}