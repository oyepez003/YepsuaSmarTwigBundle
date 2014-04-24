<?php

/*
 * This file is part of the YepsuaSmarTwigBundle.
 *
 * (c) Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yepsua\SmarTwigBundle\UI\Message;

use \YsJQuery as JQuery;
use \YsPNotify as PNotify;
use \YsJQueryConstant as JQueryConstant;

JQuery::usePlugin(JQueryConstant::PLUGIN_PNOTYFY);

/**
 * Description of Notification
 *
 * @author oyepez
 */
class Notification{
    
  public static function notice($content){
    return self::build(PNotify::notice($content));
  }
    
  public static function error($content){
    return self::build(PNotify::error($content));
  }
  
  public static function say($content){
    return self::build(PNotify::say($content));
  }
  
  public static function alarm($content){
    return self::build(PNotify::alarm($content));
  }
    
  public static function alert($content){
    return self::build(sprintf("alert('%s')",$content));
  }
    
  protected static function build($notification){
     return JQuery::newInstance()->execute($notification);
  }
}