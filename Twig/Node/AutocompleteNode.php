<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class AutocompleteNode extends SimpleNode {    
              
  public function configureCallableMethods(){
    return array(
      'values' => array('method' => '_source'),
      'separator' => array('method' => '_multiple'),
    );
  }

  public function getWidgetName(){
    return 'autocomplete';
  }

  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('input');
  }
}