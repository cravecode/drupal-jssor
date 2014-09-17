<?php

/**
 * @file
 * Preprocessors and helper functions to make theming easier.
 */

use Drupal\Core\Template\Attribute;

/**
 * Prepares variables for views jssor rows templates.
 *
 * Default template: jssor.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - view: The view object.
 *   - rows: An array of row items. Each row is an array of content.
 */
function template_preprocess_jssor(&$variables) {
  $view = $variables['view'];
  $rows = $variables['rows'];

  $style = $view->style_plugin;

  // View's options.
  $options = $style->options;

  // https://api.drupal.org/api/drupal/core!includes!common.inc/function/_drupal_add_js/8
  _drupal_add_library('jssor/jquery.jssor.slider');

  _drupal_add_js('
  jQuery(document).ready(function ($) {
    var options = {
      $FillMode: 2,
      $AutoPlay: ' . $options['autoplay']. ',
      $AutoPlayInterval: ' . $options['autoplayinterval']. ',
    };

     var jssor_slider = new $JssorSlider$("slider_container", options);
     jssor_slider.$SetScaleWidth(Math.min(bodyWidth, 1920));

  });
  ', 'inline');

  $default_row_class = isset($options['default_row_class']) ? $options['default_row_class'] : FALSE;
  foreach ($rows as $id => $row) {
    $variables['rows'][$id] = array();
    $variables['rows'][$id]['content'] = $row;
    $variables['rows'][$id]['attributes'] = array();
    if ($default_row_class) {
      $variables['rows'][$id]['attributes']['class'][] = 'views-row';
    }
    if ($row_class = $view->style_plugin->getRowClass($id)) {
      $variables['rows'][$id]['attributes']['class'][] = $row_class;
    }
    $variables['rows'][$id]['attributes'] = new Attribute($variables['rows'][$id]['attributes']);
  }
}
