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
  
# Config

SuperTheme uses Symfonys [Dependency Injection Container](http://symfony.com/doc/current/components/dependency_injection/introduction.html) 
to define services and parameters with a yaml file.

The config file is broken up into two sections. 
The parameters section is for variables you want to use throughout your script or for configuration settings for your services.
Services are class definitions. Some services automatically run commands when received and others return the class from a specified factory.

## Referencing a Parameter

To reference a Parameter in a service you wrap the key in `%`. 

```yaml
twig.loader:
    class: "Twig_Loader_Filesystem"
    arguments: ["%twig.paths%"] # loads the twig.paths parameter as an argument
```

To get the parameter in pgp you use the getParameter method.

```php
require_once __DIR__.'/App/bootstrap.php';

$translationDirectory = $container->getParameter('wordpress.translations');
```

For parameters that contain a string with a parameter in it you will have to resolve the nested parameter manually.

```php
require_once __DIR__.'/App/bootstrap.php';

$nestedParameter = $container->getParameterBag()->resolveValue(container->getParameter('some.parameter'));
```

## Retrieving a Service

The config file defines many services for you such as twig, a logger and a form handler.
to receive a services call the `get` method.

```php
require_once __DIR__.'/App/bootstrap.php';

$twig = $container->get("twig.environment");
echo $twig->render('basic.html.twig');
```

If you need to pass the service as a dependancy to another service definition you pass a string starting with a `@`.

```yaml
twig.environment:
    class: "Twig_Environment"
    arguments: ["@twig.loader", "%twig.options%"]
```

## WordPress Quickies

The parameters can be used to build out some common and basic WordPress functionality such as menus, sidebars, styles and scripts.

### Styles

You can add styles with `wordpress.styles`. This is an array of styles with an associative array that is passed to `wp_register_style`. All styles are automatically enqueued.

```
wordpress.styles:
    - { id: "app", source: "%template_uri%/web/stylesheets/app.css", deps: ~ }
```

### Scripts

You can add scripts with `wordpress.scripts`. This is an array of scripts with an associative array that is passed to `wp_register_script`. All scripts are automatically enqueued.

```
wordpress.scripts:
    - { id: "app", source: "%template_uri%/web/scripts-min/app.min.js", deps: ~, header: false }
```

### Theme Support

You can add various theme support with `wordpress.theme_support`. The default add support for html5, and post thumbnails

```yaml
  wordpress.theme_support:
    - "html5"
    - "post-thumbnails"
```

### Images Sizes

You can add image sizes by adding them to `wordpress.image_sizes`. The key is the image size name and the array is the additional args to pass to `add_image_size`

```yaml
wordpress.image_sizes:
    fullscreen: [1920, 1080, true]
```

### Menus

You can add menus locations with `wordpress.menus`. The keys are the location and the values are the descriptions.

```yaml
wordpress.menus:
    primary_menu: "Primary Menu"
```

## Sidebars

You can add sidebars with `wordpress.sidebars`. It is an array with a associative array of the args to pass to `wordpress.sidebars`.

```
wordpress.sidebars:
    - { id: "sample_sidebar", name: "sample sidebar", description: "sample sidebar managed by config file" }
```

## More Information

for more information on services and parameters read Symfonys [documentation](http://symfony.com/doc/current/components/dependency_injection/introduction.html).

# Gulp

Gulp is a task manager that will compile, merge and minify all your public web assets. 

*This theme makes use of [livereload](http://livereload.com/) which will reload your browser when you make changes to a file that is being watched.*
*To use this feature you must install the livereload add on to your browser.*

## List of Gulp Commands

| Command            | Description                                                                                   |
| ------------------ | --------------------------------------------------------------------------------------------- |
| `gulp`             | Runs gulp images, scripts, sass and watch commands in that order                              |
| `gulp images`      | Minifies images. Supports png, jpg, gif and svg.                                              |
| `gulp scripts`     | Merges javascript files and minifies them                                                     |
| `gulp styles`      | Compiles sass files into CSS                                                                  |
| `gulp watch`       | Watches source images, scripts and sass files for changes. runs appropriate command on change |
| `gulp cache:clear` | Clears the local file cache                                                                   |

## Settings

In your *gulpfile.js* you can configure its settings by editing the *options* object.

### images

| Option            | Type          | format | Description                                            |
| ----------------- | ------------- | ---    | ------------------------------------------------------ |
| src               | string\|array |        | Location of source images                              |
| dist              | string        |        | Directory to store minified images                     |
| optimizationLevel | 0-7           | png    | Optimization level for compression                     |
| progressive       | true          | jpg    | Convert to progressive                                 |
| interlaced        | true          | gif    | Convert to interlaced                                  |
| multipass         | true          | png    | Optimize svg multiple times until it's fully optimized |

### scripts

| Option | Type          | Description                                 |
| ------ | ------------- | ------------------------------------------- |
| src    | string\|array | Source javascript files to merge and minify |
| dist   | string        | Directory to store the minified Javascript  |

### styles

| Option       | Type                                  | Description                                                                                  |
| ------------ | ------------------------------------- | -------------------------------------------------------------------------------------------- |
| src          | string\|array                         | Location of source scss files                                                                |
| dist         | string                                | Directory to save compiled styles to                                                         |
| style        | nested, expanded, compact, compressed | Output format for css files                                                                  |
| includePaths | string\|array                         | An array of paths that LibSass can look in to attempt to resolve your `@import` declarations |
| comments     | bool                                  | Enables additional debugging information in the output file as CSS comments                  |