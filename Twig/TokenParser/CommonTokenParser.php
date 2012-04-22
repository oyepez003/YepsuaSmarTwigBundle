<?php

namespace Yepsua\SmarTwigBundle\Twig\TokenParser;

//TODO DELETE
use Yepsua\SmarTwigBundle\Twig\Node\ButtonNode;

class CommonTokenParser extends \Twig_TokenParser {

  protected $hasContent;
  protected $names;
  protected $values;
  protected $content;

  public function __construct() {
    $this->setHasContent(true);
  }
  
  public function parse(\Twig_Token $token){
    $options = $this->parseOptionsTag($this->parser, $this->hasContent());
    $this->setValues(isset($options['values']) ? $options['values'] : array());
    $this->setNames(isset($options['names']) ? $options['names'] : array());
    $this->setContent(isset($options['content']) ? $options['content'] : array());
    $node = $this->getNodeInstance($token);
    if($this->hasContent()){
      $node->setContent($this->getContent());
    }
    return $node;
  }
  
  public function getNodeInstance(\Twig_Token $token){
    //TODO DELETE
    return new ButtonNode($this->getNames(), new \Twig_Node($this->getValues()), $token->getLine(), $this->getTag());
  }
    
  public function parseOptionsTag(\Twig_Parser $parser,$hasContent = true,$method = 'decideBlockEnd'){
    $options = array();    
    if(!$parser->getStream()->test(\Twig_Token::BLOCK_END_TYPE)){
      do {
        $nameExpression = $this->parser->getExpressionParser()->parseExpression();
        $name = $nameExpression->getAttribute('name');
        $options['names'][$name] = $nameExpression;
        $parser->getStream()->expect(\Twig_Token::OPERATOR_TYPE, '=');
        $options['values'][$name] = $parser->getExpressionParser()->parseExpression();
      } while (!$parser->getStream()->test(\Twig_Token::BLOCK_END_TYPE));
    }
    if ($hasContent) {
      $parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
      $options['content'] = $parser->subparse(array($this, $method), true);
    }
    $parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
    return $options;
  }
  
  public function moveToNextNode(\Twig_Parser $parser){
    $parser->getStream()->next();
    $parser->getStream()->expect(\Twig_Token::BLOCK_START_TYPE);
  }

  public function decideBlockEnd(\Twig_Token $token) {
    return $token->test(sprintf('end_%s', $this->getTag()));
  }

  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui';
  }

  public function hasContent() {
    return $this->hasContent;
  }

  public function setHasContent($hasContent) {
    $this->hasContent = $hasContent;
  }

  public function getNames() {
    return $this->names;
  }

  public function setNames($names) {
    $this->names = $names;
  }

  public function getValues() {
    return $this->values;
  }

  public function setValues($values) {
    $this->values = $values;
  }

  public function getContent() {
    return $this->content;
  }

  public function setContent($content) {
    $this->content = $content;
  }
}