<?php

namespace Yepsua\SmarTwigBundle\Twig\TokenParser;

use Yepsua\SmarTwigBundle\Twig\Node\AccordionNode;

class AccordionTokenParser extends TabsTokenParser {
   
  public function getNodeInstance(\Twig_Token $token){
    return new AccordionNode($this->getNames(), new \Twig_Node($this->getValues()), $this->getSectionsNames(), new \Twig_Node($this->getSectionsValues()), $token->getLine(), $this->getTag());
  }
    
  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui_accordion';
  }
  
  public function getInternalTag(){
    return array('ui_section','ui_tab');
  }
}