<?php

/**
 * @file
 * Definition of Drupal\jssor\Plugin\views\style\Jssor.
 */

namespace Drupal\jssor\Plugin\views\style;

use Drupal\views\Plugin\views\style\StylePluginBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Style plugin to render each item in an ordered or unordered list.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "jssor",
 *   title = @Translation("Jssor Slider"),
 *   help = @Translation("Display rows or entity in a Jssor Slider."),
 *   theme = "jssor",
 *   display_types = {"normal"}
 * )
 */
class Jssor extends StylePluginBase {

  /**
   * Does the style plugin allows to use the row.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Does the style plugin support custom css class for the rows.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Does the style plugin support grouping.
   *
   * @var bool
   */
  protected $usesGrouping = FALSE;


  /**
   * {@inheritdoc}
   */
  protected function defineOptions() {
    $options = parent::defineOptions();

    // Whether to pause when mouse over if a slider is auto playing, 0: no pause, 1: pause for desktop, 2: pause for touch device, 3: pause for desktop and touch device, 4: freeze for desktop, 8: freeze for touch device, 12: freeze for desktop and touch device, default value is 1.
    // PauseOnHover.
    $options['pauseonhover'] = array('default' => 0);

    //{$PlayOrientation	optional	1	Orientation to play slide (for auto play, navigation), 1: horizental, 2: vertical, 5: horizental reverse, 6: vertical reverse
    //{$BulletNavigatorOptions}	optional	null	Options to specify and enable navigator or not
    //{$ArrowNavigatorOptions}	optional	null	Options to specify and enable arrow navigator or not
    //{$ThumbnailNavigatorOptions}	optional	null	Options to specify and enable thumbnail navigator or not
    //{$SlideshowOptions}	optional	null	Options to specify and enable slideshow or not
    //{$CaptionSliderOptions}	optional	null	Options which specifies how to animate caption

    $options['autoplay'] = array('default' => FALSE);
    $options['autoplayinterval'] = array('default' => 3000);

    return $options;
  }


  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {

    $form['autoplay'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Autoplay'),
      '#default_value' => $this->options['autoplay'],
      '#description' => t('Enable to auto play.'),
      '#weight' => -4,
    );

    $form['autoplayinterval'] = array(
      '#type' => 'number',
      '#title' => $this->t('Autoplay interval'),
      '#attributes' => array(
        'min' => 0,
        'step' => 1,
        'value' => $this->options['autoplayinterval'],
      ),
      '#description' => t('Interval (in milliseconds) to go for next slide since the previous stopped.'),
      '#weight' => -3,
    );

  }

}
