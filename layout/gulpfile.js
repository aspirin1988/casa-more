var dir_test = 'app/';


var gulp = require('gulp'),
    sass = require('gulp-sass'),
    browserSync = require('browser-sync'),
    uglify = require('gulp-uglifyjs'),
    cssnano = require('gulp-cssmin'),
    rename = require('gulp-rename');

gulp.task('mytask', function () {
    console.log('Test available')
});

gulp.task('sass', function () {
    return gulp.src(['src/scss/**/*.scss'])
        .pipe(sass())
        .pipe(gulp.dest(dir_test + 'css'))
        .pipe(cssnano())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir_test + 'css'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('scripts', function () {
    return gulp.src('src/js/**/*.js')
        .pipe(gulp.dest(dir_test + 'js'))
        .pipe(uglify())
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dir_test + 'js'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('img', function () {
    return gulp.src('src/img/*')
        .pipe(gulp.dest(dir_test + 'img'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('fonts', function () {
    return gulp.src('src/fonts/*')
        .pipe(gulp.dest(dir_test + 'fonts'))
        .pipe(browserSync.reload({stream: true}));
});

gulp.task('browser-sync', function () {
    browserSync({
        server: {
            baseDir: 'app/'
        },
        notify: true
    })
});

gulp.task('serve', ['img', 'sass', 'scripts', 'fonts', 'browser-sync'], function () {
    gulp.watch(['src/scss/**/*.scss'], ['sass', browserSync.reload]);
    gulp.watch('app/*.html', browserSync.reload);
    gulp.watch('src/js/**/*.js', ['scripts']);
    gulp.watch('src/img/*', browserSync.reload);
});
gulp.task('default', ['serve']);

