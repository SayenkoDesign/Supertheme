[![Latest Stable Version](https://poser.pugx.org/sayenkodesign/theme/v/stable)](https://packagist.org/packages/sayenkodesign/theme) 
[![Total Downloads](https://poser.pugx.org/sayenkodesign/theme/downloads)](https://packagist.org/packages/sayenkodesign/theme) 
[![Latest Unstable Version](https://poser.pugx.org/sayenkodesign/theme/v/unstable)](https://packagist.org/packages/sayenkodesign/theme) 
[![License](https://poser.pugx.org/sayenkodesign/theme/license)](https://packagist.org/packages/sayenkodesign/theme)
[![Build Status](https://travis-ci.org/SayenkoDesign/Theme.svg?branch=master)](https://travis-ci.org/SayenkoDesign/Theme)

# Requirements

To Use this theme you must have these tools installed on your dev environment

- [Composer](https://getcomposer.org/)
- [Node](https://nodejs.org/en/)
- [Bower](http://bower.io/)
- [GulpJS](http://gulpjs.com/)

This theme makes use of [livereload](http://livereload.com/) which will reload your browser when you make changes to a file that is being watched.
To use this feature you must install the livereload add on to your browser.

# Setup

Before you cn use this theme you need to go to this directory in your command line and run

- `bower install`
- `npm install`
- `composer install`

# file structure
- App: where application files like PHP classes will go
- bower_components: Directory created and managed with bower with client side libraries such as foundation-sites and jQuery.
- node_modules: Directory created and managed by node. Contains dependencies needed to run gulp commands.
- vendor: Directory created and managed with composer with PHP dependencies such as Pimple and Twig
- web: Directory with web assets such as images, javascript and stylesheets.
  - images: original images
  - images-min: images minified by gulp
  - sass: scss files
    - _settings.scss: contains all the foundation settings
    - app.scss: main scss file. You should add you styles to other files and import them here.
  - scripts: source javascripts
    - app.js: The main js file for your scripts. Any other Javascript files will need to be added to your gulp setttings
  - scripts-min: minified javascripts
  - stylesheets: compiled scss files

# Gulp

Gulp is a task manager that will compile, merge and minify all your web assets. 
If you have livereload installed and enabled in your browser it will also automatically update your browser window.

## List of Gulp Comands

| Command | Description |
| ------- | ----------- |
| gulp    | Runs gulp images, scripts, sass and watch commands in that order |
| images  | Minifies images. Supports png, jpg, gif and svg. |
| scripts | Merges javascript files and minifies them |
| sass    | Compiles sass files into CSS |
| watch   | Watches source images, scripts and sass files for changes. runs appropriate command on change |

## Settings

In your *gulpfile.js* file there is a *options* object you can use to change the most commonly changes settings.

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