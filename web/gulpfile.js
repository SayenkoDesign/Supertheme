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
    livereload   = require('gulp-livereload');

var options = {
    images: {
        src: 'images/**/*.{png,jpg,gif,svg}',
        dist: 'images-min',
        optimizationLevel: 7,
        progressive: true,
        interlaced: true,
        multipass: true
    },
    scripts: {
        src: [
            'bower_components/foundation-sites/dist/foundation.js',
            'scripts/app.js'
        ],
        dist: 'scripts-min'
    },
    styles: {
        src: 'sass/**/*.scss',
        dist: 'stylesheets',
        style: 'nested',
        includePaths: [
            'bower_components/font-awesome/scss',
            'bower_components/foundation-sites/scss'
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
    'sass',
    'watch'
]);

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

gulp.task('sass', function(){
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
    gulp.watch(options.styles.src, ['sass']);
});