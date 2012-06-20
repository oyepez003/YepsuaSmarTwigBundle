<?php

namespace Yepsua\SmarTwigBundle\Twig\Extension;

use \YsJQuery as JQuery;
use \YsPNotify as Notify;
use \YsJLayout as Layout;
use \YsComponent as Component;

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
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\MaskTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\FormWizardTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\AjaxFormTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ValidationTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\BookletTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\CycleTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\RingTokenParser(),
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
        'toggle_north' => new \Twig_Function_Method($this, 'toggleNorth',array('is_safe' => array('html'))),
        'toggle_south' => new \Twig_Function_Method($this, 'toggleSouth',array('is_safe' => array('html'))),
        'toggle_west' => new \Twig_Function_Method($this, 'toggleWest',array('is_safe' => array('html'))),
        'toggle_east' => new \Twig_Function_Method($this, 'toggleEast',array('is_safe' => array('html'))),
        'toggle_center' => new \Twig_Function_Method($this, 'toggleCenter',array('is_safe' => array('html'))),
        'animate_layout' => new \Twig_Function_Method($this, 'animateLayout',array('is_safe' => array('html'))),
        'component_render' => new \Twig_Function_Method($this, 'componentRender',array('is_safe' => array('html'))),
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
  
  public function toggleNorth($layout,$region){
    JQuery::usePlugin('jLayout');
    return str_replace(array('"'),array('\''),Layout::toggleNorthLayout($layout,$region));
  }
  
  public function toggleSouth($layout,$region){
    JQuery::usePlugin('jLayout');
    return str_replace(array('"'),array('\''),Layout::toggleSouthLayout($layout,$region));
  }
  
  public function toggleWest($layout,$region){
    JQuery::usePlugin('jLayout');
    return str_replace(array('"'),array('\''),Layout::toggleWestLayout($layout,$region));
  }

  public function toggleEast($layout,$region){
    JQuery::usePlugin('jLayout');
    return str_replace(array('"'),array('\''),Layout::toggleEastLayout($layout,$region));
  }
  
  public function toggleCenter($layout,$region){
    JQuery::usePlugin('jLayout');
    return str_replace(array('"'),array('\''),Layout::toggleCenterLayout($layout,$region));
  }
  
  public function animateLayout($layout,$region, $effect = 'bounce'){
    JQuery::usePlugin('jLayout');
    return str_replace(array('"'),array('\''),Layout::effect($layout,$region,$effect));
  }
  
  public function componentRender(Component $component){
    return $component->draw();
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