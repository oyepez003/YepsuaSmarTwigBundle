<?php

namespace Yepsua\SmarTwigBundle\Util;

class HTMLUtil {
    
  public static function getStandardHtmlProperties(){
    $standard  = array('accesskey', 'class', 'dir', 'id', 'lang', 'style', 
                       'tabindex', 'title');
    $event  = array('onblur','onclick','ondblclick','ondblclick','onmousedown',
                    'onmousemove','onmouseout','onmouseover','onmouseup',
                    'onkeydown','onkeydown','onkeypress');
    return array_merge($standard, $event);
  }
  
  public static function getHTMLProperties($args){
    return array_merge(self::getHTMLAttrs(func_get_args()), 
                       self::getStandardHtmlProperties());
  }
  
  public static function getHTMLAttrs($args){
    $args = is_array($args) ? $args : func_get_args();
    $attrs = array(
      'button'=>array('accept','align','alt','checked','disabled','maxlength','name','readonly','size','src','type','value'),
      'a' => array('charset','coords','href','hreflang','name','rel','rev','shape','rect','circle','poly','target'),
      'div' => array('align'), 
      'input' => array('accept','align','alt','checked','disabled','maxlength','name','readonly','size','src','type','value'),
      'form' => array('action','accept','accept-charset','enctype','method','name','target'),
      'select' => array('disabled','multiple','name','size'),  
      'option' => array('disabled','label','selected','value'),
      'optionWithoutLabel' => array('selected','disabled','value'),
      'ul' => array('compact','compact'),
      'li' => array('type','value'),
    );
    $attr = array();
    foreach($args as $arg){
      if(isset($attrs[$arg])){
        $attr = array_merge($attr, $attrs[$arg]);
      }
    }
    return $attr;
  }
  
}

?>
