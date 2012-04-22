<?php

namespace Yepsua\SmarTwigBundle\Twig\TokenParser;

class SectionTokenParser extends CommonTokenParser {
  
  protected $sectionsNames;
  protected $sectionsValues;
  protected $sectionsContents;
  protected $strict;
  
  public function __construct() {
    parent::__construct();
    $this->setStrict(true);
  }
  
  public function parse(\Twig_Token $token) {
    $tabsOptions = $this->parseOptionsTag($this->parser, false);
    $this->moveToNextNode($this->parser);
    if($this->isStrict()){
      if(!$this->parser->getStream()->test($this->getInternalTag())){
        throw new \Twig_Error_Syntax(sprintf("The node '%s' needs at least one '%s' child node ",$this->getTag(), $this->getInternalTagToString()),$token->getLine());
      }
    }
    do{
      $this->parser->getStream()->next();
      $tabData[] = $this->parseOptionsTag($this->parser, true, 'decideUISectionEnd');
      $this->moveToNextNode($this->parser);
    } while($this->parser->getStream()->test($this->getInternalTag()));
    $this->parser->getStream()->expect(\Twig_Token::NAME_TYPE);
    $this->parser->getStream()->expect(\Twig_Token::BLOCK_END_TYPE);
    if(isset($tabsOptions['values'])){
      $this->setValues($tabsOptions['values']);
    }else{
      $this->setValues(array());
    }
    if(isset($tabsOptions['names'])){
      $this->setNames($tabsOptions['names']);
    }else{
      $this->setNames(array());
    }
    $sectionNames = array();
    $sectionValues = array();
    $sectionContents = array();
    foreach($tabData as $data){
      $sectionNames[] = $data['names'];
      $sectionValues[] = $data['values'];
      $sectionContents[] = $data['content'];
    }
    $this->setSectionsNames($sectionNames);
    $this->setSectionsValues($sectionValues);
    $this->setSectionsContents($sectionContents);
    $node = $this->getNodeInstance($token);
    if($this->hasContent()){
      $node->setContent($this->getSectionsContents());
    }
    return $node;
  }
  
  public function decideUISectionEnd(\Twig_Token $token) {
    return $token->test('end_ui_section');
  }
  
  public function decideBlockEnd(\Twig_Token $token) {
    return $token->test('end_ui_sections');
  }
  
  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui_sections';
  }
  
  public function getInternalTag(){
    return 'ui_section';
  }
  
  public function getInternalTagToString(){
    $val = '';
    if(is_array($this->getInternalTag())){
      foreach($this->getInternalTag() as $tag){
        $val .= $tag . ' or ';
      }
      $val = substr($val, 0, -3);
    }else{
      $val =  $this->getInternalTag();
    }
    return $val;
  }
  
  public function getSectionsNames() {
    return $this->sectionsNames;
  }

  public function setSectionsNames($sectionsNames) {
    $this->sectionsNames = $sectionsNames;
  }

  public function getSectionsValues() {
    return $this->sectionsValues;
  }

  public function setSectionsValues($sectionsValues) {
    $this->sectionsValues = $sectionsValues;
  }

  public function getSectionsContents() {
    return $this->sectionsContents;
  }

  public function setSectionsContents($sectionsContents) {
    $this->sectionsContents = $sectionsContents;
  }
  
  public function isStrict() {
    return $this->strict;
  }

  public function setStrict($strict) {
    $this->strict = $strict;
  }
}