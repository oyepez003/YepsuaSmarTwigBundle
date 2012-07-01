<?php

namespace Yepsua\SmarTwigBundle\Twig\Extension;

use \YsJsFunction;

class JsSintaxExtension extends \Twig_Extension {
  
  /**
  * Returns a list of functions to add to the existing list.
  *
  * @return array An array of functions
  */
  public function getFunctions(){
    return array(
        'js_function' => new \Twig_Function_Method($this, 'jsFunction'),
        'js_sintax' => new \Twig_Function_Method($this, 'jsSintax'),
        'js_call_function' => new \Twig_Function_Method($this, 'jsCallFunction'),
        'js_callback' => new \Twig_Function_Method($this, 'jsCallFunction'),
    );
  }
  
  public function jsFunction($argsOrBody, $body = null){
    if($body !== null){
      $function = new YsJsFunction($body, $argsOrBody);
    }else{
      $function = new YsJsFunction($argsOrBody);
    }
    return $function;
  }
  
  public function jsSintax($sintax){
    return YsJsFunction::call($sintax);
  }
  
  public function jsCallFunction($functionName){
    return YsJsFunction::call($functionName);
  }

  /**
   * Returns the name of the extension.
   *
   * @return string The extension name
   */
  public function getName() {
    return 'js.sintax';
  }
}