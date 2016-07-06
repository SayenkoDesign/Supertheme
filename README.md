[![Latest Stable Version](https://poser.pugx.org/sayenkodesign/theme/v/stable)](https://packagist.org/packages/sayenkodesign/theme) 
[![Total Downloads](https://poser.pugx.org/sayenkodesign/theme/downloads)](https://packagist.org/packages/sayenkodesign/theme) 
[![Latest Unstable Version](https://poser.pugx.org/sayenkodesign/theme/v/unstable)](https://packagist.org/packages/sayenkodesign/theme) 
[![License](https://poser.pugx.org/sayenkodesign/theme/license)](https://packagist.org/packages/sayenkodesign/theme)
[![Build Status](https://travis-ci.org/SayenkoDesign/Supertheme.svg?branch=master)](https://travis-ci.org/SayenkoDesign/Supertheme)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/130a3186-3fc2-455a-a30d-e3860b0b9960/mini.png)](https://insight.sensiolabs.com/projects/130a3186-3fc2-455a-a30d-e3860b0b9960)

# Requirements

To Use this theme you must have these tools installed on your dev environment

- [Composer](https://getcomposer.org/)
- [Node](https://nodejs.org/en/)
- [Bower](http://bower.io/)
- [GulpJS](http://gulpjs.com/)

# Setup

In the theme directory run the following commands

- `bower install`
- `npm install`
- `composer install`

# File Structure

- App: Directory for your php and configs
  - bootstrap.php: bootstraps the supertheme by creating and loading the container. Include this to load SuperTheme in any file such as functions.php or index.php
  - config: Store yaml config files in here
  - src: place your classes in here. src is mapped to the \App namespace and will automatically load if you include the bootstrap file or composers autoload file
- docs: more detailed documentation on specific subjects
- languages: directory for translation files
- src: contains supertheme classes, styles and views. You should not edit these files.
- tests: contains unit test for theme.
- var: will contain caches and logs.
- views: directory for twig templates
- web: directory for public web assets
  - libs: created after running bower install. this is where your bower dependencies will be saved
  - scripts: scripts go in here
  - scripts-min: gulp will place minified scripts in here
  - scss: scss files go in here
  - stylesheets: gulp will place compiled css files in here
  

# Gulp

Gulp is a task manager that will compile, merge and minify all your public web assets. 

*This theme makes use of [livereload](http://livereload.com/) which will reload your browser when you make changes to a file that is being watched.*
*To use this feature you must install the livereload add on to your browser.*

## List of Gulp Commands

| Command | Description |
| ------- | ----------- |
| `gulp`         | Runs gulp images, scripts, sass and watch commands in that order |
| `gulp images`  | Minifies images. Supports png, jpg, gif and svg. |
| `gulp scripts` | Merges javascript files and minifies them |
| `gulp styles`  | Compiles sass files into CSS |
| `gulp watch`   | Watches source images, scripts and sass files for changes. runs appropriate command on change |

## Settings

In your *gulpfile.js* you can configure its settings by editing the *options* object.

### images

| Option | Type | Default | format |Description |
| ------ | ---- | ------- | ------ | ---------- |
| src    | string\|array | `"web/images/**/*.{png,jpg,gif,svg}"` | | Location of source images |
| dist   | string | `"web/images-min"` | | Directory to store minified images |
| optimizationLevel | 0-7 | 7 | png | Optimization level for compression |
| progressive | true | bool | jpg | Convert to progressive |
| interlaced | true | bool | gif | Convert to interlaced |
| multipass | true | bool | png | Optimize svg multiple times until it's fully optimized |

### scripts

| Option | Type | Default |Description |
| ------ | ---- | ------- | ---------- |
| src | string\|array | `[` | Source javascript files to merge and minify |
|     |               | `    "bower_components/foundation-sites/dist/foundation.js",` | |
|     |               | `    "web/scripts/app.js"` | |
|     |               | `]`
| dist | string | `"web/scripts-min"` | Directory to store the minified Javascript |

### styles

| Option | Type | Default |Description |
| ------ | ---- | ------- | ---------- |
| src | string\|array | `"web/sass/**/*.scss"` | Location of source scss files |
| dist | string | `"web/stylesheets"` | Directory to save compiled styles to
| style | nested, expanded, compact, compressed | `"nested"` | Output format for css files |
| includePaths | string\|array | `[` | An array of paths that LibSass can look in to attempt to resolve your `@import` declarations |
|              |               | `    "bower_components/font-awesome/scss",` | |
|              |               | `    "bower_components/foundation-sites/scss"` | |
|              |               | `]`
| comments     | bool | true | Enables additional debugging information in the output file as CSS comments |