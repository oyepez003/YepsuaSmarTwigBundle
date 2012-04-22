<?php

namespace Yepsua\SmarTwigBundle\Twig\Extension;

class HTMLExtension extends \Twig_Extension {
  
  /**
   * Returns the token parser instance to add to the existing list.
   *
   * @return array An array of Twig_TokenParser instances
   */
  public function getTokenParsers() {
    return array(
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\OptionItemTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ContentTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\HeaderTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\SubMenuTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\MenuItemTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\MenuHeaderTokenParser(),
    );
  }

  /**
   * Returns the name of the extension.
   *
   * @return string The extension name
   */
  public function getName() {
    return 'html.core';
  }
  
}