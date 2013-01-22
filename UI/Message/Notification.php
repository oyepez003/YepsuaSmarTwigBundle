<?php

namespace Yepsua\SmarTwigBundle\UI\Message;

use \YsJQuery as JQuery;
use \YsPNotify as PNotify;
use \YsJQueryConstant as JQueryConstant;

/**
 * Description of Notification
 *
 * @author oyepez
 */
class Notification{
  
  public static function notice($content){
    JQuery::usePlugin(JQueryConstant::PLUGIN_PNOTYFY);
    return self::build(PNotify::notice($content));
  }
    
  public static function error($content){
    JQuery::usePlugin(JQueryConstant::PLUGIN_PNOTYFY);
    return self::build(PNotify::error($content));
  }
  
  public static function say($content){
    JQuery::usePlugin(JQueryConstant::PLUGIN_PNOTYFY);
    return self::build(PNotify::say($content));
  }
  
  public static function alarm($content){
    JQuery::usePlugin(JQueryConstant::PLUGIN_PNOTYFY);
    return self::build(PNotify::alarm($content));
  }
    
  public static function alert($content){
    return self::build(sprintf("alert('%s')",$content));
  }
    
  protected static function build($notification){
     return JQuery::newInstance()->execute($notification);
  }
}