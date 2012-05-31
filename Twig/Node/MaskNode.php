<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class MaskNode extends SimpleNode {    
    
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setOnlyJsS(!$this->getNode('values')->hasNode('value'));
    $this->setIsPlugin(true);
  }

  public function configureCallableMethods(){
    return array(
      'for' => array('method' => 'in'),
      'mode' => array('method' => '_type'),
    );
  }

  public function getWidgetName(){
    return 'mask';
  }

  public function getPluginName() {
    return 'jqMask';
  }

  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('div','input');
  }
}