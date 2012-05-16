<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

/**
 * 
 */
class NotifyNode extends SimpleNode {    
    
    public function __construct($names, $values, $lineno, $tag = null) {
      parent::__construct($names, $values, $lineno, $tag);
      $this->setOnlyJsS(true);
      $this->setIsPlugin(true);
      $this->setInSelector(false);
    }
  
    public function configureCallableMethods(){
      return array(
        'title' => array('method' => '_pnotify_title'),
        'type' => array('method' => '_pnotify_type'),
        'label' => array('method' => '_pnotify_text'),
        'message' => array('method' => '_pnotify_text'),
        'stack' => array('method' => '_pnotify_stack'),
        'addClass' => array('method' => '_pnotify_addclass'),
        'width' => array('method' => '_pnotify_width'),
        'height' => array('method' => '_pnotify_height'),
        'insertBrs' => array('method' => '_pnotify_insert_brs'),
        'nonblock' => array('method' => '_pnotify_nonblock'),
        'nonblockOpacity' => array('method' => '_pnotify_nonblock_opacity'),
        'mouseReset' => array('method' => '_pnotify_mouse_reset'),
        'hide' => array('method' => '_pnotify_hide'),
        'closer' => array('method' => '_pnotify_closer'),
        'history' => array('method' => '_pnotify_history'),
        'animateSpeed' => array('method' => '_pnotify_animate_speed'),
        'opacity' => array('method' => '_pnotify_opacity'),
        'noticeIcon' => array('method' => '_pnotify_notice_icon'),
        'errorIcon' => array('method' => '_pnotify_error_icon'),
        'shadow' => array('method' => '_pnotify_shadow'),
        'minHeight' => array('method' => '_pnotify_min_height'),
        'maxHeight' => array('method' => '_pnotify_max_height'),
        'minWidth' => array('method' => '_pnotify_min_width'),
        'maxWidth' => array('method' => '_pnotify_max_width'),
        'animation' => array('method' => '_pnotify_animation'),
        'delay' => array('method' => '_pnotify_delay'),
        'beforeOpen' => array('method' => '_pnotify_before_open'),
        'afterOpen' => array('method' => '_pnotify_after_open'),
        'beforeClose' => array('method' => '_pnotify_before_close'),
        'afterClose' => array('method' => '_pnotify_after_close'),
        'beforeInit' => array('method' => '_pnotify_before_init'),
        'afterInit' => array('method' => '_pnotify_after_init'),
        'queueRemove' => array('method' => '_pnotify_queue_remove'),
        'for' => array('method' => 'in'),
      );
    }
            
    public function getWidgetName(){
      return 'notify';
    }
    
    public function getPluginName() {
      return 'pnotify';
    }
}