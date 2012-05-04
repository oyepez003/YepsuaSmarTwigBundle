<?php

namespace Yepsua\SmarTwigBundle\Twig\Extension;

class UICoreExtension extends UIWidgetExtension {
   
  /**
   * Returns the token parser instance to add to the existing list.
   *
   * @return array An array of Twig_TokenParser instances
   */
  public function getTokenParsers() {
    return array(
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\DialogTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\TabsTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\AccordionTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ProgressbarTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\SliderTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\AutocompleteTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\DatepickerTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ButtonTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ButtonsetTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\MultiselectTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\PicklistTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\PopUpTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\SelectMenuTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ExpanderTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\SplitterTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\DynamicSelectTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\MenuTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\PanelTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\TooltipTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\RCTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\DraggableTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\DroppableTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\EffectTokenParser(),
        new \Yepsua\SmarTwigBundle\Twig\TokenParser\ResizableTokenParser(),
    );
  }

  /**
   * Returns the name of the extension.
   *
   * @return string The extension name
   */
  public function getName() {
    return 'ui.core';
  }
}