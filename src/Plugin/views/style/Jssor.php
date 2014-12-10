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
    $options['autoplay'] = array('default' => TRUE);
    $options['autoplayinterval'] = array('default' => 3000);
    $options['arrownavigator'] = array('default' => FALSE);
    $options['bulletnavigator'] = array('default' => FALSE);
    $options['chancetoshow'] = array('default' => 0);
    $options['arrowskin'] = array('default' => 1);
    $options['bulletskin'] = array('default' => 1);
    $options['autocenter'] = array('default' => 0);
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['global'] = array(
      '#type' => 'fieldset',
      '#title' => 'Global',
    );
    $form['global']['autoplay'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Autoplay'),
      '#default_value' => (isset($this->options['global']['autoplay'])) ?
        $this->options['global']['autoplay'] : $this->options['autoplay'],
      '#description' => t('Enable to auto play.'),
    );
    $form['global']['autoplayinterval'] = array(
      '#type' => 'number',
      '#title' => $this->t('Autoplay interval'),
      '#attributes' => array(
        'min' => 0,
        'step' => 1,
        'value' => (isset($this->options['global']['autoplayinterval'])) ?
          $this->options['global']['autoplayinterval'] : $this->options['autoplayinterval'],
      ),
      '#description' => t('Interval (in milliseconds) to go for next slide since the previous stopped.'),
      '#states' => array(
        'visible' => array(
          ':input[name="style_options[global][autoplay]"]' => array('checked' => TRUE),
        ),
      ),
    );
    $form['global']['arrownavigator'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable arrow navigator'),
      '#default_value' => (isset($this->options['global']['arrownavigator'])) ?
        $this->options['global']['arrownavigator'] : $this->options['arrownavigator'],
    );
    $form['global']['bulletnavigator'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enable bullet navigator'),
      '#default_value' => (isset($this->options['global']['bulletnavigator'])) ?
        $this->options['global']['bulletnavigator'] : $this->options['bulletnavigator'],
    );

    // Arrow navigator.
    $form['arrownavigator'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Arrow navigator'),
      '#states' => array(
        'visible' => array(
          ':input[name="style_options[global][arrownavigator]"]' => array('checked' => TRUE),
        ),
      ),
    );
    $arrowskin = array();
    for ($i = 1 ; $i < 22; $i++) {
      $i = ($i < 10) ? '0' . $i : $i;
      $arrowskin[$i] = $this->t('Arrow ') . $i;
    }
    $form['arrownavigator']['arrowskin'] = array(
      '#type' => 'select',
      '#title' => $this->t('Skin'),
      '#default_value' => (isset($this->options['arrownavigator']['arrowskin'])) ?
        $this->options['arrownavigator']['arrowskin'] : $this->options['arrowskin'],
      '#options' => $arrowskin,
    );
    $form['arrownavigator']['autocenter'] = array(
      '#type' => 'select',
      '#title' => $this->t('Auto center'),
      '#description' => $this->t('Auto center arrows in parent container'),
      '#default_value' => (isset($this->options['arrownavigator']['autocenter'])) ?
        $this->options['arrownavigator']['autocenter'] : $this->options['autocenter'],
      '#options' => array(
        0 => $this->t('No'),
        1 => $this->t('Horizontal'),
        2 => $this->t('Vertical'),
        3 => $this->t('Both'),
      ),
    );
    $form['arrownavigator']['chancetoshow'] = array(
      '#type' => 'select',
      '#title' => $this->t('Chance to show'),
      '#default_value' => (isset($this->options['arrownavigator']['chancetoshow'])) ?
        $this->options['arrownavigator']['chancetoshow'] : $this->options['chancetoshow'],
      '#options' => array(
        0 => $this->t('Never'),
        1 => $this->t('Mouse Over'),
        2 => $this->t('Always'),
      ),
    );

    // Bullet navigator.
    $form['bulletnavigator'] = array(
      '#type' => 'fieldset',
      '#title' => $this->t('Bullet navigator'),
      '#states' => array(
        'visible' => array(
          ':input[name="style_options[global][bulletnavigator]"]' => array('checked' => TRUE),
        ),
      ),
    );
    $bulletskin = array();
    for ($i = 1 ; $i < 22; $i++) {
      $i = ($i < 10) ? '0' . $i : $i;
      $bulletskin[$i] = $this->t('Bullet ') . $i;
    }
    $form['bulletnavigator']['bulletskin'] = array(
      '#type' => 'select',
      '#title' => $this->t('Skin'),
      '#default_value' => (isset($this->options['bulletnavigator']['bulletskin'])) ?
        $this->options['bulletnavigator']['bulletskin'] : $this->options['bulletskin'],
      '#options' => $bulletskin,
    );
    $form['bulletnavigator']['autocenter'] = array(
      '#type' => 'select',
      '#title' => $this->t('Auto center'),
      '#description' => $this->t('Auto center arrows in parent container'),
      '#default_value' => (isset($this->options['bulletnavigator']['autocenter'])) ?
        $this->options['bulletnavigator']['autocenter'] : $this->options['autocenter'],
      '#options' => array(
        0 => $this->t('No'),
        1 => $this->t('Horizontal'),
        2 => $this->t('Vertical'),
        3 => $this->t('Both'),
      ),
    );
    $form['bulletnavigator']['chancetoshow'] = array(
      '#type' => 'select',
      '#title' => $this->t('Chance to show'),
      '#default_value' => (isset($this->options['bulletnavigator']['chancetoshow'])) ?
        $this->options['bulletnavigator']['chancetoshow'] : $this->options['chancetoshow'],
      '#options' => array(
        0 => $this->t('Never'),
        1 => $this->t('Mouse Over'),
        2 => $this->t('Always'),
      ),
    );
  }
}
