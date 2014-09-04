<?php

/**
 * @file
 * Preprocessors and helper functions to make theming easier.
 */

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
  $options = $style->options;

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
