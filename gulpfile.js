var gulp         = require('gulp'),
    concat       = require('gulp-concat'),
    sass         = require('gulp-sass'),
    compass      = require('gulp-compass'),
    autoprefix   = require('gulp-autoprefixer'),
    uglify       = require('gulp-uglify'),
    imagemin     = require('gulp-imagemin'),
    plumber      = require('gulp-plumber'),
    rename       = require('gulp-rename'),
    notify       = require('gulp-notify'),
    watch        = require('gulp-watch'),
    livereload   = require('gulp-livereload'),
    del          = require('del');

var options = {
    images: {
        src: 'web/images/**/*.{png,jpg,gif,svg}',
        dist: 'web/images-min',
        optimizationLevel: 7,
        progressive: true,
        interlaced: true,
        multipass: true
    },
    scripts: {
        src: [
            'web/libs/foundation-sites/dist/foundation.js',
            'web/libs/fancybox/source/jquery.fancybox.js',
            'web/libs/slick-carousel/slick/slick.js',
            'web/scripts/app.js'
        ],
        dist: 'web/scripts-min'
    },
    styles: {
        src: [
            'web/libs/fancybox/source/jquery.fancybox.css',
            'web/libs/slick-carousel/slick/slick.css',
            'web/libs/slick-carousel/slick/slick-theme.css',
            'web/scss/**/*.scss'
        ],
        dist: 'web/stylesheets',
        style: 'nested',
        includePaths: [
            'web/libs/font-awesome/scss',
            'web/libs/foundation-sites/scss',
            'src/web/scss'
        ],
        sourceComments: true
    }
};

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
    gulp.src(options.images.src).pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(imagemin({
            optimizationLevel:  options.images.optimizationLevel,
            progressive:        options.images.progressive,
            interlaced:         options.images.interlaced,
            multipass:          options.images.multipass
        }))
        .pipe(gulp.dest(options.images.dist))
        .pipe(livereload());
});

gulp.task('scripts', function(){
    gulp.src(options.scripts.src)
        .pipe(concat('app.js'))
        .pipe(plumber(plumberErrorHandler))
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest(options.scripts.dist))
        .pipe(livereload());
});

gulp.task('styles', function(){
    gulp.src(options.styles.src).pipe(plumber(plumberErrorHandler))
        .pipe(sass({
            style:          options.scripts.style,
            includePaths:   options.styles.includePaths,
            comments:       options.styles.comments,
            source_map:     options.styles.source_map,
            time:           options.styles.time
        }))
        .pipe(autoprefix('last 4 version'))
        .pipe(gulp.dest(options.styles.dist))
        .pipe(livereload());
});

gulp.task('watch', function(){
    livereload.listen();
    gulp.watch(options.images.src, ['images']);
    gulp.watch(options.scripts.src, ['scripts']);
    gulp.watch(options.styles.src, ['styles']);
});