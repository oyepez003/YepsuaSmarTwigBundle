<?php

namespace Yepsua\SmarTwigBundle\Twig\Extension;

use \YsJQuery as JQuery;
use \YsPNotify as Notify;

class UIAddonsExtension extends UIWidgetExtension {
  
  /**
   * Returns the token parser instance to add to the existing list.
   *
   * @return array An array of Twig_TokenParser instances
   */
  public function getTokenParsers() {
    return array(
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\BlockUITokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\BoxTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ColorpickerTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\NotifyTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\HotkeyTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\IdleMonitorTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\KeypadTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\CalculatorTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\LayoutTokenParser(),
    );
  }
  
  /**
  * Returns a list of functions to add to the existing list.
  *
  * @return array An array of functions
  */
  public function getFunctions(){
    return array(
        'notify' => new \Twig_Function_Method($this, 'notify',array('is_safe' => array('html'))),
        'notify_error' => new \Twig_Function_Method($this, 'notifyError',array('is_safe' => array('html'))),
    );
  }
  

  public function notify($arg0 = "",$arg1 = null,$arg2 = null,$arg3 = null){
    $options = array();
    $options['pnotify_text'] = "";
    if(is_array($arg0)){
      $options = $arg0;
    }else{
      $options['pnotify_text'] = $arg0;
      if($arg1 !== null) $options['pnotify_title'] = $arg1;
      if($arg2 !== null) $options['pnotify_stack'] = $arg2;
      if($arg3 !== null) $options['pnotify_type'] = $arg3;
    }
    JQuery::usePlugin('pnotify');
    return str_replace(array("'",'"'),array("\'",'\''),Notify::build($options));
  }
  
  public function notifyError($arg0 = "",$arg1 = null,$arg2 = null){
    return $this->notify($arg0,$arg1,$arg2,Notify::ERROR_TYPE);
  }
  
  /**
   * Returns the name of the extension.
   *
   * @return string The extension name
   */
  public function getName() {
    return 'ui.addons';
  }
}