<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

use \Twig_Node;
use \Twig_Compiler;
use \Twig_Node_Expression;
use \Twig_Node_Expression_Constant;
use \Twig_Node_Expression_Name;

use \Yepsua\SmarTwigBundle\Util\HTMLUtil;

class CommonNode extends Twig_Node {
  
  private static $LOOP_VAR = 'loop';
  
  protected $content;
  protected $indexVar;
  protected $id;
  protected $selector;
  protected $varName;
  protected $htmlProperties;
  protected $execute;
  protected $loop;
  protected $optionsVarName;
  protected $callableMethods;
  protected $iterable;
  protected $iteratorValue;
  protected $iteratorVarName;
  protected $validateEmpty;
  protected $emptyMessage;
  protected $isRenderizable;
  protected $onlyJsS;
  protected $onlyHTML;
  protected $inSelector;
  protected $isExec;
  protected $isBuiltByListener;
  protected $isPlugin;
  
  public function __construct(array $nodes = array(), array $attributes = array(), $lineno = 0, $tag = null) {
    parent::__construct($nodes, $attributes, $lineno, $tag);
    $this->setOnlyHTML(false);
    $this->setOnlyJsS($this->getNode('values')->hasNode('builtIn'));
    $this->setInSelector(true);
    $this->setExec(true);
    $this->setBuiltByListener($this->getNode('values')->hasNode('builtBy'));
  }
  
  
  /**
   *
   * @return type 
   */
  public function getId() {
    return $this->id . $this->getSuffixId();
  }
  
  /**
   *
   * @param type $id 
   */
  public function setId($id) {
    $this->id = $id;
  }
  
  /**
   *
   * @return type 
   */
  public function getSelector() {
    return $this->selector;
  }
  
  /**
   *
   * @param type $selector 
   */
  public function setSelector($selector) {
    $this->selector = $selector;
  }
  
  /**
   *
   * @return type 
   */
  public function getVarName() {
    return $this->varName;
  }
  
  /**
   *
   * @param type $varName 
   */
  public function setVarName($varName) {
    $this->varName = $varName;
  }
  
  /**
   *
   * @return type 
   */
  public function getHtmlProperties() {
    return $this->htmlProperties;
  }
  
  /**
   *
   * @param type $htmlProperties 
   */
  public function setHtmlProperties($htmlProperties) {
    $this->htmlProperties = $htmlProperties;
  }
  
  /**
   *
   * @return type 
   */
  public function getExecuteSintax() {
    return $this->execute;
  }
  
  /**
   *
   * @param type $execute 
   */
  public function setExecuteSintax($execute) {
    $this->execute = $execute;
  }
  
  /**
   *
   * @return type 
   */
  public function hasLoop() {
    return $this->loop;
  }
  
  /**
   *
   * @param type $loop 
   */
  public function setLoop($loop) {
    $this->loop = $loop;
  }
  
  /**
   *
   * @return type 
   */
  public function getOptionsVarName() {
    return $this->optionsVarName;
  }
  
  /**
   *
   * @param type $optionsVarName 
   */
  public function setOptionsVarName($optionsVarName) {
    $this->optionsVarName = $optionsVarName;
  }
  
  /**
   *
   * @return type 
   */
  public function isIterable() {
    return $this->iterable;
  }
  
  /**
   *
   * @param type $iterable 
   */
  public function setIterable($iterable) {
    $this->iterable = $iterable;
  }
  
  /**
   *
   * @return type 
   */
  public function getIteratorValue() {
    return $this->iteratorValue;
  }
  
  /**
   *
   * @param type $iteratorValue 
   */
  public function setIteratorValue($iteratorValue) {
    $this->iteratorValue = $iteratorValue;
  }
  
  /**
   *
   * @return type 
   */
  public function getIteratorVarName() {
    return $this->iteratorVarName;
  }
  
  /**
   *
   * @param type $iteratorVarName 
   */
  public function setIteratorVarName($iteratorVarName) {
    $this->iteratorVarName = $iteratorVarName;
  }

    
  /**
   *
   * @return type 
   */
  public function getIndexVar() {
    return $this->indexVar;
  }
  
  /**
   *
   * @param type $indexVar 
   */
  public function setIndexVar($indexVar) {
    $this->indexVar = $indexVar;
  }
  
  /**
   *
   * @return type 
   */
  public function isValidateEmpty() {
    return $this->validateEmpty;
  }
  
  /**
   *
   * @param type $validateEmpty 
   */
  public function setValidateEmpty($validateEmpty) {
    $this->validateEmpty = $validateEmpty;
  }
  
  /**
   *
   * @return type 
   */
  public function getEmptyMessage() {
    return $this->emptyMessage;
  }
  
  /**
   *
   * @param type $emptyMessage 
   */
  public function setEmptyMessage($emptyMessage) {
    $this->emptyMessage = $emptyMessage;
  }

    
  /**
   *
   * @return type 
   */
  public function getValues(){
    return $this->getNode('values');
  }
  
  /**
   *
   * @return type 
   */
  public function getNames(){
    return $this->getAttribute('names');
  }
  
  /**
   *
   * @return type 
   */
  public function isRenderizable() {
    return $this->isRederizable;
  }
  
  /**
   *
   * @param type $isRederizable 
   */
  public function setRenderizable($isRederizable) {
    $this->isRederizable = $isRederizable;
  }
  
  /**
   *
   * @return type 
   */
  public function isIterableNode() {
    return false;
  }
  
  public function isOnlyJsS() {
    return $this->onlyJsS;
  }

  public function setOnlyJsS($onlyJsS) {
    $this->onlyJsS = $onlyJsS;
  }

  public function isOnlyHTML() {
    return $this->onlyHTML;
  }

  public function setOnlyHTML($onlyHTML) {
    $this->onlyHTML = $onlyHTML;
  }
  
  public function isInSelector() {
    return $this->inSelector;
  }

  public function setInSelector($inSelector) {
    $this->inSelector = $inSelector;
  }
  
  public function isExec() {
    return $this->isExec;
  }

  public function setExec($isExec) {
    $this->isExec = $isExec;
  }
  
  public function isBuiltByListener() {
    return $this->isBuiltByListener;
  }

  public function setBuiltByListener($isBuiltByListener) {
    $this->isBuiltByListener = $isBuiltByListener;
  }
  
  public function isPlugin() {
    return $this->isPlugin;
  }

  public function setIsPlugin($isPlugin) {
    $this->isPlugin = $isPlugin;
  }
  
  public function getRenderizableConditionNode($node = null){
    $rNode = null;
    if($node === null){
      $rNode = $this->getNode('values')->getNode('rendered');
    }else{
      $rNode = $node->getNode('rendered');
    }
    return $rNode;
  }

  public function getCommonsCallableMethods(){
    return array(
      'widgetVar' => array('method' => 'assignToVar', 
                           'args' => array(false)
      ),
      'timeout' => array('method' => 'timeout'),
      'confirmation' => array('method' => 'confirmation'),  
      'condition' => array('method' => 'condition'),
      'interval' => array('method' => 'setInterval'),
      'options' => array('method' => 'setOptions'),
    );
  }
  
  public function init(){
    $this->defineId();
    $this->defineVarName();
    $this->defineIsRenderizable();
    //$this->buildWidgetVar();
    $this->defineOptionsVarName();
    $this->buildSintaxConfiguration();
    if($this->isIterableNode()){
      $this->buildIterableSintax();
    }
    $this->setEmptyMessage("No Data Found");
  }
  
  /**
   * Compiles the node to PHP.
   *
   * @param Twig_Compiler A Twig_Compiler instance
   */
  public function compile(Twig_Compiler $compiler){
    $this->init();
    if($this->isRenderizable()){
      $this->compileIfRendered($compiler, $this->getRenderizableConditionNode());
    }
    $this->preCompileWidget($compiler);
    $this->compileWidget($compiler);
    $this->postCompileWidget($compiler);
    if($this->isRenderizable()){
      $this->compileEndIf($compiler);
    }
  }
  
  /**
   * Compiles the widgetn-ode to PHP.
   *
   * @param Twig_Compiler A Twig_Compiler instance
   */
  public function compileWidget(Twig_Compiler $compiler){
    return false;
  }
  
  /**
   * Compiles the widgetn-ode to PHP.
   *
   * @param Twig_Compiler A Twig_Compiler instance
   */
  public function preCompileWidget(Twig_Compiler $compiler){
    return false;
  }
  
    /**
   * Compiles the widgetn-ode to PHP.
   *
   * @param Twig_Compiler A Twig_Compiler instance
   */
  public function postCompileWidget(Twig_Compiler $compiler){
    return false;
  }
  
  /**
   *
   * @param type $name 
   */
  public function removePropertie($name){
    if(!in_array($name, $this->noRemovableProperties())){
      $names = $this->getAttribute('names');
      unset ($names[$name]);
      $this->setAttribute('names', $names);
      $this->getNode('values')->removeNode($name);
    }
  }
  
  public function noRemovableProperties(){
    return array();
  }
  
  /**
   *
   * @param array $names 
   */
  public function removeProperties(array $names){
    foreach($names as $name){
      $this->removePropertie($name);
    }
  }
  
  /**
   *
   * @param type $nodeName
   * @return type 
   */
  public function getNodeValue($nodeName, $twigNode = null){
    if($twigNode === null){
      $node = $this->getNode('values')->getNode($nodeName);
    }else{
      $node = $twigNode->getNode($nodeName);
    }
    return $node->getAttribute('value');
  }
  
  /**
   *
   * @param type $nodeName
   * @param type $appendValue
   * @param type $parentNode 
   */
  public function appendValueInNode($nodeName, $appendValue, $parentNode = 'values'){
    $node = $this->getNode($parentNode)->getNode($nodeName);
    $node->setAttribute('value',sprintf('%s%s',$node->getAttribute('value'),$appendValue));
    $this->getNode($parentNode)->setNode($nodeName, $node);
  }
  
  /**
   *
   * @param type $nodeName
   * @param type $appendValue
   * @param type $parentNode 
   */
  public function appendValueInNode2($twigNode, $appendValue){
    $twigNode->setAttribute('value',sprintf('%s%s',$twigNode->getAttribute('value'),$appendValue));
  }
  
  /**
   *
   * @param type $nodeName
   * @param type $prependValue
   * @param type $parentNode 
   */
  public function prependValueInNode($nodeName, $prependValue,$parentNode = 'values'){
    $node = $this->getNode($parentNode)->getNode($nodeName);
    $node->setAttribute('value',sprintf('%s%s',$prependValue,$node->getAttribute('value')));
    $this->getNode($parentNode)->setNode($nodeName, $node);
  }
  
  public function addNode($key,Twig_Node_Expression $newNode, Twig_Node_Expression $newName, $node = null, $attribute = null){
    if($node === null){
      $this->getNode('values')->setNode($key, $newNode);
    }else{
      $node->setNode($key, $newNode);
    }
    if($attribute === null){
      $names = $this->getAttribute('names');
      $names[$key] = $newName;
      $this->setAttribute('names', $names);
    }else{
      $names = $attribute;
      $names[$key] = $newName;
    }
    return array('node' => $node, 'attribute' => $attribute);
  }
  
  public function addExpressionConstantNode($key,$nodeValue,$lineno){
    $node = new Twig_Node_Expression_Constant($nodeValue, $lineno);
    $name = new Twig_Node_Expression_Name($key, $lineno);
    return $this->addNode($key,$node, $name);
  }
  
  /**
   *
   * @return type 
   */
  public function getContent() {
    return $this->content;
  }
  
  /**
   *
   * @param type $content 
   */
  public function setContent($content) {
    $this->content = $content;
  }
  
  /**
   *
   * @return type 
   */
  public function buildId() {
    $id = null;
    if ($this->getNode('values')->hasNode('id')
        && $this->getNode('values')->getNode('id') instanceof Twig_Node_Expression_Constant ) {
      $id = $this->getNode('values')->getNode('id')->getAttribute('value');
    } else {
      $id = sprintf('%s%s',$this->getWidgetName(),rand(1, 1000));
    }
    //$this->removePropertie('id');
    return $id;
  }
  
  public function defineId() {
    $this->setId($this->buildId());
  }
  
  public function buildOptionsVarName(){
    return sprintf('%s%s',$this->getVarName(),'Options');
  }
  
  public function defineOptionsVarName (){
    $this->setOptionsVarName($this->buildOptionsVarName());
  }
  
  public function buildVarName() {
    $suffix = ($this->getId() instanceof Twig_Node) ? rand(1,1000) :  $this->getId();
    $suffix = str_replace(array('-','.'),'_', $suffix);
    return sprintf('$%s%s', $this->getWidgetName(), $suffix);
  }
  
  public function defineVarName() {
    $this->setVarName($this->buildVarName());
  }
  
  public function defineIsRenderizable(){
    if($this->hasNode('values')){
      $this->setRenderizable($this->getNode('values')->hasNode('rendered'));
    }else{
      $this->setRenderizable(false);
    }
  }

  public function buildHtmlProperties(){
    $htmlProperties = ($this->getNode('values')->hasNode('htmlProperties')) 
      ? $this->getNodeValue('htmlProperties') 
      : null;
    $this->removePropertie('htmlProperties');
    $this->setHtmlProperties($htmlProperties);
  }
    
  public function compileStandardHtmlProperties(Twig_Compiler $compiler, $node = null){
    $node = ($node === null) ? $this->getNode('values') : $node;
    $attrs = $this->getStandardHtmlProperties();
    $compiler->raw('preg_replace(\'/\w=""/\'," ",""');
    foreach($attrs as $attr){
      if($node->hasNode($attr)){
        $compiler->raw(' . sprintf(\'');
        $compiler->raw(sprintf('%s="', $attr), true);
        $compiler->raw('%s"\',');
        $compiler->subcompile($node->getNode($attr));
        $compiler->raw(')');
        if($attr !== 'id'){
          $this->removePropertie($attr);
        }
      }
    }
    $compiler->raw(')');
  }
  
  public function getStandardHtmlProperties(){
    return array_merge(HTMLUtil::getStandardHtmlProperties(), $this->configureHTMLProperties());
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('div');
  }
  
  public function compileHtmlProperties(Twig_Compiler $compiler, $args = array()){
    $this->compileStandardHtmlProperties($compiler);
    $compiler->write(');');
    $compiler->raw("\n");
  }
  
  
  public function buildWidgetVar(){
    if($this->getNode('values')->hasNode('widgetVar')){
      $this->prependValueInNode('widgetVar', 'var ');
    }
  }
  
  public function buildSintaxConfiguration(){
    $execute = ($this->getNode('values')->hasNode('executeOnReady') 
            && $this->getNodeValue('executeOnReady')) 
            ? '->executeOnReady()'
            : '->execute()';
    $this->removePropertie('executeOnReady');
    $execute = ($this->getNode('values')->hasNode('showSintax') 
            && $this->getNodeValue('showSintax'))
            ? ''
            : '->execute()';
    $this->removePropertie('showSintax');
    $this->setExecuteSintax($execute);
  }
  
  public function buildIterableSintax(){
      $this->setIndexVar(self::$LOOP_VAR);
      
      $this->setLoop(false);
      $this->isIterable(false);
      $this->setValidateEmpty(false);
      
      if($this->getNode('values')->hasNode('indexVar')){
         $this->setLoop(true);
         $this->setIndexVar($this->getNodeValue('indexVar'));
         $this->removePropertie('indexVar');
      }
      
      if($this->getNode('values')->hasNode('values')){
        $this->setIterable(true); 
        $this->setIteratorValue($this->getNodeValue('values'));
        $this->removePropertie('values');
      }
      
      if($this->getNode('values')->hasNode('var')){
         $this->setIterable(true); 
         $this->setIteratorVarName($this->getNodeValue('var'));
         $this->removePropertie('var');
      }
      
      if($this->getNode('values')->hasNode('emptyMessage')){
         $this->setValidateEmpty(true);
         $this->setEmptyMessage($this->getNodeValue('emptyMessage'));
         $this->removePropertie('emptyMessage');
      }
      
  }
  
  /**
   *
   * @param \Twig_Compiler $compiler
   */
  public function compileOptions(Twig_Compiler $compiler) {
    $i = 0;
    $compiler->write(sprintf('%s = array(', $this->getOptionsVarName()));
    $compiler->raw("\n");
    $compiler->indent();
      foreach ($this->getNames() as $name) {
        if(!in_array($name->getAttribute('name'), $this->getAllOptionsToSkip())){
          $names[$name->getAttribute('name')] = sprintf('"%s" =>', $name->getAttribute('name'));
        }
      }
      foreach ($this->getValues() as $key => $node) {
        if (isset($names[$key])) {
          $conpile = true;
          if($this->getAllCallableMethods() !== null){
            foreach($this->getAllCallableMethods() as $keyC => $valueC){
              if($keyC === $key){
                $conpile = false;
                break;
              }
            }
          }
          if($conpile){
            $compiler->write($names[$key]);
            $compiler->subcompile($node);
            $compiler->raw(",");
            $compiler->raw("\n");
          }
        }
      }
    $compiler->outdent();
    $compiler->write(");\n");
  }
  
  /**
   *
   * @param \Twig_Compiler $compiler
   */
  public function compileCallableMethods(Twig_Compiler $compiler){ 
    $callableMethods = $this->getAllCallableMethods();
    foreach($callableMethods as $name => $data){
      if($this->getNode('values')->hasNode($name)){
        $compiler->write(sprintf('->%s(',$data['method']));
        $compiler->subcompile($this->getNode('values')->getNode($name));
        if(isset($data['args'])){
          foreach($data['args'] as $arg){
            $compiler->raw(",");
            $compiler->subcompile(new Twig_Node_Expression_Constant($arg, 0));
          }
        }
        $this->removePropertie($name);
        $compiler->raw(")\n");
      }
    }
  }
  
  public function configureCallableMethods(){
    return array();
  }
  
  public function getAllCallableMethods(){
    $methods = array_merge($this->getCommonsCallableMethods(),$this->configureCallableMethods());
    
    return $methods;
  }
  
  public function getAllOptionsToSkip(){
    return array_merge($this->getStandardHtmlProperties(),$this->getOptionsToSkip());
  }
  
  public function getOptionsToSkip(){
    return array();
  }
  
  public function replaceIndexVar($string){
    if(is_array($string)){
      $replacedValues = array();
      foreach($string as $val){
        $replacedValues[] = str_replace("%INDEX_VAR%",$this->getIndexVar(), $val);
      }
    }
    return str_replace("%INDEX_VAR%",$this->getIndexVar(), $string);
  }
  
  public function compileIteratorInitSintax(Twig_Compiler $compiler){
      foreach($this->getIteratorInitSintax() as $sintax){
        $compiler->write($sintax);
        $compiler->raw("\n");
      }
    }
    
  public function compileIteratorEndSintax(Twig_Compiler $compiler, $validateEmpty = false){
    foreach($this->getIteratorEndSintax($validateEmpty) as $sintax){
      $compiler->write($sintax);
      $compiler->raw("\n");
    }
  }
  
  public function compileIfRendered(Twig_Compiler $compiler, $rendered, $isForIterableSection = false){
    $compiler->write('if(');
    $compiler->indent();
      $compiler->subcompile($rendered);
    $compiler->raw("){\n");
    if($isForIterableSection){
      $compiler->write('$context[\'_hasContent\'] = true;');
      $compiler->raw("\n");
      $compiler->write($this->replaceIndexVar('if(isset($context[\'%INDEX_VAR%\'][\'renderedIndex\']))$context[\'%INDEX_VAR%\'][\'renderedIndex\']++;'));
    }
    $compiler->raw("\n");
  }
    
  public function compileEndIf(Twig_Compiler $compiler){
    $compiler->outdent();
    $compiler->write('}');
    $compiler->raw("\n");
  }
  
  public function compileWidgetId(Twig_Compiler $compiler){
    if ($this->getNode('values')->hasNode('id')
        && !$this->getNode('values')->getNode('id') instanceof Twig_Node_Expression_Constant) {
      $compiler->subcompile($this->getNode('values')->getNode('id'));
    } else {
      $compiler->raw(sprintf('"%s"',$this->getId()));
    }
  }
  
  public function compileSelector(Twig_Compiler $compiler, $selector = '#'){
    if($this->getNode('values')->hasNode('builtIn')){
      $compiler->subcompile($this->getNode('values')->getNode('builtIn'));
    }else{
      if ($this->getNode('values')->hasNode('id')
        && !$this->getNode('values')->getNode('id') instanceof Twig_Node_Expression_Constant) {
        $compiler->raw(sprintf('"%s" . ', $selector));
        $compiler->subcompile($this->getNode('values')->getNode('id'));
      } else {
        $compiler->raw(sprintf('"%s%s"', $selector, $this->getId()));
      }
    }
  }
  
  public function compileExtension(Twig_Compiler $compiler){
    if($this->isPlugin()){
      $compiler->write(sprintf('$this->env->getExtension(\'ui.core\')->getWidget(\'ui.jqueryCore\')->usePlugin(\'%s\');',$this->getPluginName()));
      $compiler->raw("\n");
    }
    $compiler->write(sprintf('%s = $this->env->getExtension(\'%s\')->getWidget(\'ui.%s\');',$this->getVarName(),$this->getExtensionIndex(),$this->getWidgetName()));
    $compiler->raw("\n");
  }
  
  public function getExtensionIndex(){
    return ($this->isPlugin()) ? 'ui.addons' :'ui.core';
  }
  
  public function compileInitWidget(Twig_Compiler $compiler){
    $compiler->write(sprintf('echo %s->initWidget(',$this->getVarName()));
    $this->compileWidgetId($compiler);
    $compiler->raw(',');
  }
  
  public function compileEndWidget(Twig_Compiler $compiler){
    $compiler->write(sprintf('echo %s->endWidget();',$this->getVarName()));
    $compiler->raw("\n");
  }
  
  public function compileBuilder(Twig_Compiler $compiler){
    if($this->isBuiltByListener()){
      $compiler->raw(sprintf('%s',$this->getVarName()));
    }else{
      $compiler->write(sprintf('echo %s',$this->getVarName()));
    }
    $this->compileBuilderFuntcionName($compiler);
    if($this->isExec()){
      $compiler->indent();
      $compiler->indent();
      if($this->isBuiltByListener()){
        $compiler->indent();
      }
      if($this->isInSelector()){
        $compiler->write("\n");
        $compiler->write('->in(');
        $this->compileSelector($compiler);
        $compiler->raw(')');
      }
      $compiler->write("\n");
      $compiler->write(sprintf("->addOptions(%s)\n",$this->getOptionsVarName()));
    }else{
      $compiler->write(';');
    }
  }
  
  public function compileListener(Twig_Compiler $compiler){
    $compiler->write('$jQuery = $this->env->getExtension(\'ui.core\')->getWidget(\'ui.jqueryCore\');');
    $compiler->raw("\n");
    $compiler->write('echo $jQuery');
    $compiler->indent();
    $compiler->indent();
    if($this->getNode('values')->hasNode('builtByEvent')){
      $compiler->raw('->setEvent(');
      $compiler->subcompile($this->getNode('values')->getNode('builtByEvent'));
      $compiler->raw(")\n");
    }
    if($this->getNode('values')->hasNode('builtByEvent')){
      $compiler->write('->in(');
      $compiler->subcompile($this->getNode('values')->getNode('builtBy'));
      $compiler->raw(")\n");
    }
    $compiler->write('->execute(');
  }
  
  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    $compiler->raw('->build()');
  }
  
  public function compileExecute(Twig_Compiler $compiler){
    if($this->isBuiltByListener()){
      $compiler->write(')');
    }else{
      $compiler->write(sprintf('%s;',$this->getExecuteSintax()));
    }
    $compiler->outdent();
    $compiler->outdent();
    if($this->isBuiltByListener()){
      $compiler->outdent();
      $compiler->raw("\n");
      $compiler->write('->setPreSintax("$(document).ready(function(){")');
      $compiler->raw("\n");
      $compiler->write('->setPostSintax("})")');
      $compiler->raw("\n");
      $compiler->write('->execute();');
      $compiler->raw("\n");
      $compiler->outdent();
      $compiler->outdent();
    }
    $compiler->write("\n");
  }
  
  public function getIteratorInitSintax(){
    $sintax = array(
      '$context[\'_parent\'] = (array) $context;',
      sprintf('$context[\'_seq\'] = twig_ensure_traversable($this->getContext($context, "%s"));', $this->getIteratorValue()),
      '$context[\'_iterated\'] = false;',
    );

    if($this->hasLoop()){
      $loop = $this->replaceIndexVar(array('$context[\'%INDEX_VAR%\'] = array(',
        '  \'parent\' => $context[\'_parent\'],',
        '  \'index0\' => 0,',
        '  \'index\'  => 1,',
        '  \'renderedIndex\'  => 0,',
        '  \'first\'  => true,',
      ');',
      'if (is_array($context[\'_seq\']) || (is_object($context[\'_seq\']) && $context[\'_seq\'] instanceof Countable)) {',
      '  $length = count($context[\'_seq\']);',
      '  $context[\'%INDEX_VAR%\'][\'revindex0\'] = $length - 1;',
      '  $context[\'%INDEX_VAR%\'][\'revindex\'] = $length;',
      '  $context[\'%INDEX_VAR%\'][\'length\'] = $length;',
      '  $context[\'%INDEX_VAR%\'][\'last\'] = 1 === $length;',
      '}',));
      $sintax = array_merge($sintax, $loop);
    }

    $sintax[] = sprintf('foreach ($context[\'_seq\'] as $context["_key"] => $context["%s"]) {', $this->getIteratorVarName());
    $sintax[] = str_replace("%ITERATOR_VARNAME%",$this->getIteratorVarName(),'if (isset($context["%ITERATOR_VARNAME%"])) { $_%ITERATOR_VARNAME%_ = $context["%ITERATOR_VARNAME%"]; } else { $_%ITERATOR_VARNAME%_ = null; }');    
    return $sintax;
  }

  public function getIteratorEndSintax($validateEmpty = false){
    $sintax = array(
      '    $context[\'_iterated\'] = true;',
    );

    if($this->hasLoop()){
      $loop = $this->replaceIndexVar(array('    ++$context[\'%INDEX_VAR%\'][\'index0\'];',
          '    ++$context[\'%INDEX_VAR%\'][\'index\'];',
          '    $context[\'%INDEX_VAR%\'][\'first\'] = false;',
          '    if (isset($context[\'%INDEX_VAR%\'][\'length\'])) {',
              '    --$context[\'%INDEX_VAR%\'][\'revindex0\'];',
              '    --$context[\'%INDEX_VAR%\'][\'revindex\'];',
              '    $context[\'%INDEX_VAR%\'][\'last\'] = 0 === $context[\'%INDEX_VAR%\'][\'revindex0\'];',
          '    }'));
      $sintax = array_merge($sintax, $loop);
    }

    $sintax[] = '}';                  
    
    if($validateEmpty){
      $sintax = array_merge($sintax,array(
          'if (!$context[\'_iterated\'] || !isset($context[\'_hasContent\'])) {',
          sprintf('  echo "%s";', $this->getEmptyMessage()),
          '}',
      ));
    }
    
    $sintax = array_merge($sintax,array(
        '$_parent = $context[\'_parent\'];',
        $this->replaceIndexVar('unset($context[\'_seq\'], $context[\'_hasContent\'], $context[\'_iterated\'], $context[\'_key\'], $context[\'user\'], $context[\'_parent\'], $context[\'%INDEX_VAR%\']);'),
        '$context = array_merge($_parent, array_intersect_key($context, $_parent));',
    ));
    return $sintax;
  }
    
  /**
   *
   * @return type 
   */
  public function getWidgetName(){
    return 'widget';
  }
  
  public function getSuffixId(){
    return false;
  }
  
  public function getHTMLAttrs($args){
    return HTMLUtil::getHTMLAttrs(func_get_args());
  }
  
  public function getPluginName() {
    return 'plugin';
  }
 
}