<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

class SelectMenuNode extends SimpleNode {
    
  public function getWidgetName(){
    return 'selectmenu';
  }
  
  public function configureHTMLProperties(){
    return array('disabled','multiple','name','size');
  }
  
}