const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const concat = require('gulp-concat');
const rename = require('gulp-rename');

// Define the SASS compilation task
gulp.task('sass', function () {
    return gulp.src(['frontend/css/src/**/*.sass', 'frontend/css/beer-reviews-frontend.scss'])
        .pipe(sass().on('error', sass.logError))
        .pipe(concat('beer-reviews-frontend.css'))
        .pipe(gulp.dest('frontend/css'))
        .pipe(rename({ suffix: '.min' }))
        .pipe(gulp.dest('frontend/css'));
});

// Define a default task
gulp.task('default', gulp.series('sass'));

// Watch for changes in SASS files
gulp.task('watch', function () {
    gulp.watch(['frontend/css/src/**/*.sass', 'frontend/css/beer-reviews-frontend.scss'], gulp.series('sass'));
});
