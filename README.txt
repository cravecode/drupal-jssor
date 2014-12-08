Installation

First you create new folder either in the sites/all/modules folder or just
directly in the modules folder at the drupal root.
The good news is that you can move the folder event after it's already enable.
No more need to rebuild the registry. You can thanks the clever autoloading
capability of Drupal 8.

Requirements

Download the jssor slider, rename the folder as 'jssor-slider' and place it
under your libraries folder. So you structure should look like this:
libraries/jssor-slider/js/jssor.slider.min.js

http://www.jssor.com/download-jssor-slider-from-github.html

Road map
1) Add drush support to download library.
2) Add more options
3) Add more theming

More info:

http://js-tutorial.com/jssor-slider-556
https://www.drupal.org/node/2274843





$AutoPlay: true, //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
$AutoPlaySteps: 1,    //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
$AutoPlayInterval: 2000,   //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
$PauseOnHover: 1,//[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

$ArrowKeyNavigation: true,   			  //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
$SlideEasing: $JssorEasing$.$EaseOutQuint,//[Optional] Specifies easing for right to left animation, default value is $JssorEasing$.$EaseOutQuad
$SlideDuration: 800,  //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
$MinDragOffsetToSlide: 20, //[Optional] Minimum drag offset to trigger slide , default value is 20
//$SlideWidth: 600,   //[Optional] Width of every slide in pixels, default value is width of 'slides' container
//$SlideHeight: 300,  //[Optional] Height of every slide in pixels, default value is height of 'slides' container
$SlideSpacing: 0, 					 //[Optional] Space between each slide in pixels, default value is 0
$DisplayPieces: 1,    //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
$ParkingPosition: 0,  //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
$UISearchMode: 1,//[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
$PlayOrientation: 1,  //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
$DragOrientation: 1,  //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

$ArrowNavigatorOptions: {  //[Optional] Options to specify and enable arrow navigator or not
$Class: $JssorArrowNavigator$,   //[Requried] Class to create arrow navigator instance
$ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
$AutoCenter: 2,   //[Optional] Auto center arrows in parent container, 0 No, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
$Steps: 1,   //[Optional] Steps to go for each navigation request, default value is 1
$Scale: false,    //Scales bullets navigator or not while slider scale
},

$BulletNavigatorOptions: {  //[Optional] Options to specify and enable navigator or not
$Class: $JssorBulletNavigator$,   //[Required] Class to create navigator instance
$ChanceToShow: 2, //[Required] 0 Never, 1 Mouse Over, 2 Always
$AutoCenter: 1,   //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
$Steps: 1,   //[Optional] Steps to go for each navigation request, default value is 1
$Lanes: 1,   //[Optional] Specify lanes to arrange items, default value is 1
$SpacingX: 12,//[Optional] Horizontal space between each item in pixel, default value is 0
$SpacingY: 4,//[Optional] Vertical space between each item in pixel, default value is 0
$Orientation: 1,  //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
$Scale: false,    //Scales bullets navigator or not while slider scale
}
