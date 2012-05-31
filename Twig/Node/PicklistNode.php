<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

class PicklistNode extends SimpleNode {
    
  public function getWidgetName(){
    return 'picklist';
  }
    
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('select');
  }
}