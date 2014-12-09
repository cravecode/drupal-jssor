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

    var options = {
      $AutoPlay: true,
      $AutoPlaySteps: 1,
      $AutoPlayInterval: 2000,
      $PauseOnHover: 1,
      $ArrowKeyNavigation: true,
      $SlideEasing: $JssorEasing$.$EaseOutQuint,
      $SlideDuration: 800,
      $MinDragOffsetToSlide: 20,
      $SlideSpacing: 0,
      $DisplayPieces: 1,
      $ParkingPosition: 0,
      $UISearchMode: 1,
      $PlayOrientation: 1,
      $DragOrientation: 1,
      $ArrowNavigatorOptions: {
        $Class: $JssorArrowNavigator$,
        $ChanceToShow: 2,
        $AutoCenter: 2,
        $Steps: 1,
        $Scale: false
      },
      $BulletNavigatorOptions: {
        $Class: $JssorBulletNavigator$,
        $ChanceToShow: 2,
        $AutoCenter: 1,
        $Steps: 1,
        $Lanes: 1,
        $SpacingX: 12,
        $SpacingY: 4,
        $Orientation: 1,
        $Scale: false
      }
    };

    if (settings.$ArrowNavigatorOptions.$Class) {
      settings.$ArrowNavigatorOptions.$Class = $JssorArrowNavigator$;
    }

    if (settings.$BulletNavigatorOptions.$Class) {
      settings.$BulletNavigatorOptions.$Class = $JssorBulletNavigator$;
    }

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
