# 1.0.0
- added changelog 

## 1.0.1
- set google analytics and sharethis widths to 50% in theme options
- added description to google analytics field in theme options
- updated field keys for theme options
- added copyright field to theme options
- add copyright to footer
- rework footer html
- make archive post titles links
- make share this custom font awesome icons by default
- only include sharethis if an id is set
- move title to share panel view and allow user to set to false

## 1.0.2
- don't replace jquery version on login or register pages

# 2.0.0
- changelog formatting
- removed compass from gulp
- replaced options array with a number of variables that are easier to edit
- build unminified js files with -debug suffix
- add inline js options to gulp
- build unminified css files with -debug suffix and sourceComments enabled
- added php codesniffer to composer
- supertheme namespaced mapped to app/src
- moved some src views to main views and removed the rest
- broke up bootstrap code and src/functions into multiple files located in the includes directory
- moved and merged src/web files with web
- deleted src directory
- updated missing timber error message
- moved theme settings to the settings menu
- removed all views other than index.php will add better default views in the next minor release
- only show acf menu when in debug mode by default
- create tabs for theme options
- renamed config folder to acf
- add inline scripts and js support
- add inline styles support

# planned
- use -debug styles and scripts automatically when in debug mode
- new documentation
- new 404 view
- new blog related views
- added lorem ispum filter to timber