/**
 * @file
 * Handles AJAX fetching of views, including filter submission and response.
 */
(function ($, Drupal, drupalSettings) {

  "use strict";

  var ScaleSlider = function ScaleSlider( event ) {
    var slider = event.data.slider;
    var selector = event.data.selector;
    var parentwith = $('#' + selector).parent().width();
    slider.$ScaleWidth(parentwith);
  }

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
    var parentwith = $('#' + selector).parent().width();
    var slider = new $JssorSlider$(selector, settings);

    $(window).on( "resize", {
      slider: slider,
      selector: selector
    }, ScaleSlider );

    $(window).on( "load", {
      slider: slider,
      selector: selector
    }, ScaleSlider );

    $(window).on( "orientationchange", {
      slider: slider,
      selector: selector
    }, ScaleSlider );

  };

})(jQuery, Drupal, drupalSettings);
