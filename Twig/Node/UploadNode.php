<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

class UploadNode extends SimpleNode {
  
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setIsPlugin(true);
  }
  
  public function configureCallableMethods(){
    return array(
      'maxFileSize' => array('method' => '_maxFileSize'),
      'action' => array('method' => '_action'),
      'chunkSize' => array('method' => '_chunkSize'),
      'uniqueNames' => array('method' => '_uniqueNames'),
      'filtersOption' => array('method' => '_filtersOption'),
      'flashSwfUrl' => array('method' => '_flashSwfUrl'),
      'silverlightXapUrl' => array('method' => '_silverlightXapUrl'),
      'browseButton' => array('method' => '_browseButton'),
      'multipleQueues' => array('method' => '_multipleQueues'),
      'requiredFeatures' => array('method' => '_requiredFeatures'),
      'multipartParams' => array('method' => '_multipartParams'),
      'parameters' => array('method' => '_parameters'),
      'dropElement' => array('method' => '_dropElement'),
      'urlstreamUpload' => array('method' => '_urlstreamUpload'),
      'filters' => array('method' => '_filters'),  
    );
  }
  
  public function getWidgetName(){
    return 'upload';
  }
 
  public function getPluginName() {
    return 'jqUpload';
  }
  
}