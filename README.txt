First you create new folder either in the sites/all/modules folder or just directly in the modules folder at the drupal root.
The good news is that you can move the folder event after it's already enable. No more need to rebuild the registry.
You can thanks the clever autoloading capability of Drupal 8.

Info files are now being written in YAML. You'd better get use to the new markup language as it has been adopted quite thoroughly in Drupal for settings and configuration.
The good news is that is fairly simple.
More info https://www.drupal.org/node/2000204

name: Jssor Slider
type: module
description: 'Jssor Slider'
package: Slider
version: VERSION
core: 8.x

Next we will create a .module which is not mandatory anymore. We use is to set up permissions and any theme we need.







http://js-tutorial.com/jssor-slider-556
