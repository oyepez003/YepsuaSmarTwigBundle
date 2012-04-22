<?php

namespace Yepsua\SmarTwigBundle\Twig\TokenParser;

use Yepsua\SmarTwigBundle\Twig\Node\SelectMenuNode;

class SelectMenuTokenParser extends CommonTokenParser {
  
  public function getNodeInstance(\Twig_Token $token){
    return new SelectMenuNode($this->getNames(), new \Twig_Node($this->getValues()),  $token->getLine(), $this->getTag());
  }
  
  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui_selectmenu';
  }
}