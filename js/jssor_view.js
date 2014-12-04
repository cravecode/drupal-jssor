/**
 * @file
 * Handles AJAX fetching of views, including filter submission and response.
 */
(function ($, Drupal, drupalSettings) {

  "use strict";

  /**
   * Attaches the Jssor behavior to Views.
   */
  Drupal.behaviors.ViewsJssorView = {};
  Drupal.behaviors.ViewsJssorView.attach = function () {
    if (drupalSettings && drupalSettings.views && drupalSettings.views.jssorViews) {
      var jssorViews = drupalSettings.views.jssorViews;
      for (var i in jssorViews) {
        if (jssorViews.hasOwnProperty(i)) {
          Drupal.views.instances[i] = new Drupal.views.jssorView(jssorViews[i]);
        }
      }
    }
  };

  Drupal.views = {};
  Drupal.views.instances = {};

  /**
   * Javascript object for a certain view.
   */
  Drupal.views.jssorView = function (settings) {
    var selector = 'slider-dom-id-' + settings.view_dom_id;
    this.$slider = new $JssorSlider$(selector, settings);
    this.$slider.$SetScaleWidth(Math.min(bodyWidth, 1920));
  };

})(jQuery, Drupal, drupalSettings);
