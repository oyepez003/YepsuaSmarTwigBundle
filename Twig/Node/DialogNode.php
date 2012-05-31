<?php

namespace Yepsua\SmarTwigBundle\Twig\Node;

class DialogNode extends SimpleNode {
           
  public function configureCallableMethods(){
    return array(
      'maximizable' => array('method' => '_maximizable'),
      'minimizable' => array('method' => '_minimizable'),
      'pinnable'    => array('method' => '_pinnable'),
      'refreshable' => array('method' => '_refreshable'),
      'togglable' => array('method' => '_togglable'),
      'closeable' => array('method' => '_closeable'),
      'widgetVar' => array('method' => 'assignToVar'));
  }

  public function getWidgetName(){
    return 'dialog';
  }
}