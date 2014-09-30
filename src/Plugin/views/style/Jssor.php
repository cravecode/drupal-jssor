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
 *   help = @Translation("Jssor Slider."),
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
