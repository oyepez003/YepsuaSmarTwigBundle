<?php

namespace Yepsua\SmarTwigBundle\Twig\Extension;

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
    );
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