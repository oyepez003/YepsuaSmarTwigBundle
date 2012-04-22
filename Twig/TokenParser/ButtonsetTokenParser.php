<?php

namespace Yepsua\SmarTwigBundle\Twig\TokenParser;

use Yepsua\SmarTwigBundle\Twig\Node\ButtonNode;

class ButtonsetTokenParser extends CommonTokenParser {
  
  public function getNodeInstance(\Twig_Token $token){
    return new ButtonNode($this->getNames(), new \Twig_Node($this->getValues()), $token->getLine(), $this->getTag(), true);    
  }
  
  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui_buttonset';
  }
}