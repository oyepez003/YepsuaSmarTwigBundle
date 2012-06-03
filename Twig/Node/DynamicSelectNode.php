<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

class DynamicSelectNode extends SimpleNode {
    
  public function getWidgetName(){
    return 'dynaselect';
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('select');
  }
}