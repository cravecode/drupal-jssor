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

  // Attach library.
  $view->element['#attached']['library'][] = 'jssor/jquery.jssor.slider';

  // Attach settings javascript.
  $settings = array(
    'views' => array(
      'jssorViews' => array(
        'views_dom_id:' . $view->dom_id => array(
          'view_name' => $view->storage->id(),
          'view_display_id' => $view->current_display,
          'view_base_path' => $view->getPath(),
          'view_dom_id' => $view->dom_id,
          'arrownavigator' => $options['global']['arrownavigator'],
          'bulletnavigator' => $options['global']['bulletnavigator'],
          '$AutoPlay' => $options['global']['autoplay'],
          '$AutoPlayInterval' => $options['global']['autoplayinterval'],
          '$ArrowNavigatorOptions' => array(
            '$Class' => '$JssorArrowNavigator$',
          ),
          '$BulletNavigatorOptions' => array(
            '$Class' => '$JssorBulletNavigator$',
          ),
        ),
      ),
    ),
  );

  $view->element['#attached']['js'][] = array(
    'type' => 'setting',
    'data' => $settings,
  );

  // Create a unique slider ID.
  $variables['slider_id'] = 'slider-dom-id-' . $view->dom_id;

  // Enable arrow navigator.
  $variables['arrownavigator'] = $options['global']['arrownavigator'];

  // Enable bullet navigator.
  $variables['bulletnavigator'] = $options['global']['bulletnavigator'];

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
