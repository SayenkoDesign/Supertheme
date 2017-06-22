var gulp         = require('gulp'),
    concat       = require('gulp-concat'),
    sass         = require('gulp-sass'),
    autoprefix   = require('gulp-autoprefixer'),
    uglify       = require('gulp-uglify'),
    imagemin     = require('gulp-imagemin'),
    plumber      = require('gulp-plumber'),
    rename       = require('gulp-rename'),
    notify       = require('gulp-notify'),
    watch        = require('gulp-watch'),
    livereload   = require('gulp-livereload'),
    del          = require('del'),
    newer        = require('gulp-newer'),
    sprite       = require('gulp.spritesmith');

var inline_scripts_src = [
    'web/scripts/inline.js'
];
var scripts_src = [
    'web/libs/foundation-sites/dist/js/foundation.js',
    'web/libs/fancybox/source/jquery.fancybox.js',
    'web/libs/slick-carousel/slick/slick.js',
    'src/web/scripts/app.js',
    'web/scripts/app.js'
];
var scripts_dist = 'web/scripts-min';
var images_src = 'web/images/**/*.{png,jpg,gif,svg}';
var images_dist = 'web/images-min';
var sprites_src = 'web/sprite-images';
var styles_src = [
    'web/scss/**/*.scss'
];
var styles_paths = [
    'web/libs/font-awesome/scss',
    'web/libs/foundation-sites/scss',
    'src/web/scss'
];
var styles_dist = 'web/stylesheets';

var plumberErrorHandler = { errorHandler: notify.onError({
    title: 'Gulp',
    message: 'Error: <%= error.message %>'
})};

gulp.task('default', [
    'images',
    'scripts',
    'styles',
    'watch'
]);

gulp.task('cache:clear', function() {
    del(['./var/**/*']);
});

gulp.task('images', function(){
    gulp.src(images_src).pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(newer(images_dist))
        .pipe(imagemin({
            optimizationLevel:  7,
            progressive:        true,
            interlaced:         true,
            multipass:          true
        }))
        .pipe(gulp.dest(images_dist))
        .pipe(livereload());
});

gulp.task('scripts', function(){
    // app
    gulp.src(scripts_src)
        .pipe(concat('app.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(scripts_dist));

    // app debug
    gulp.src(scripts_src)
        .pipe(concat('app.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '-debug' }))
        .pipe(gulp.dest(scripts_dist));

    // inline
    gulp.src(inline_scripts_src)
        .pipe(concat('inline.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(scripts_dist));

    // inline debug
    gulp.src(inline_scripts_src)
        .pipe(concat('inline.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '-debug' }))
        .pipe(gulp.dest(scripts_dist))
        .pipe(livereload());
});

gulp.task('sprites', function () {
    // css needs to be css to compile correctly
    // saving in scss folder so scss files can include and extend it
    var spriteData = gulp.src(sprites_src).pipe(sprite({
        imgName: images_dist+'/sprite-map.png',
        cssName: styles_dist+'/sprite-map.css'
    }));
    // not including path since the other options have the full path
    return spriteData.pipe(gulp.dest('./'));
});

gulp.task('styles', function(){
    // minified
    gulp.src(styles_src).pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            style:          "compressed",
            includePaths:   styles_paths,
            comments:       true,
            sourceComments: false
        }))
        .pipe(autoprefix('last 4 version'))
        .pipe(gulp.dest(styles_dist));

    // debug
    gulp.src(styles_src).pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            style:          "expanded",
            includePaths:   styles_paths,
            comments:       true,
            sourceComments: true
        }))
        .pipe(rename({ suffix: '-debug' }))
        .pipe(autoprefix('last 4 version'))
        .pipe(gulp.dest(styles_dist))
        .pipe(livereload());
});

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch(sprites_src, ['sprites']);
    gulp.watch(images_src, ['images']);
    gulp.watch(scripts_src, ['scripts']);
    gulp.watch(inline_scripts_src, ['scripts']);
    gulp.watch(styles_src, ['styles']);
});
