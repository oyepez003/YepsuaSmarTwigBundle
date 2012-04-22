<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class AutocompleteNode extends SimpleNode {    
              
    public function configureCallableMethods(){
      return array(
        'value' => array('method' => '_source'),
        'separator' => array('method' => '_multiple'),
      );
    }
        
    public function getWidgetName(){
      return 'autocomplete';
    }
}