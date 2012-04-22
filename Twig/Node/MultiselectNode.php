<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

class MultiselectNode extends SimpleNode {
    
  public function getWidgetName(){
    return 'multiselect';
  }
  
  public function configureHTMLProperties(){
    return array('disabled','multiple','name','size');
  }
  
}