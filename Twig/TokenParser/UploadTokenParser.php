<?php

namespace Yepsua\SmarTwigBundle\Twig\TokenParser;

use Yepsua\SmarTwigBundle\Twig\Node\UploadNode;

class UploadTokenParser extends CommonTokenParser {
  
  public function getNodeInstance(\Twig_Token $token){
    return new UploadNode($this->getNames(), new \Twig_Node($this->getValues()), $token->getLine(), $this->getTag());
  }

  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui_upload';
  }
}