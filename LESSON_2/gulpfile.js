var gulp = require('gulp'),
	concatCss = require('gulp-concat-css'),
	cssmin = require('gulp-minify-css'),
	rename = require('gulp-rename'),
    notify = require('gulp-notify'),
    stylus = require('gulp-stylus');

gulp.task('css', function () {
  return gulp.src('./public/css/*.css')
    .pipe(concatCss("bundle.css"))
    .pipe(cssmin())
    .pipe(rename('bundle.min.css'))
    .pipe(notify('Done!'))
    .pipe(gulp.dest('./public/build/'));
});

gulp.task('watch', function () {
    gulp.watch('./public/css/*.css', ['css', 'styl'])
});

gulp.task('styl', function() {
    return gulp.src('./public/stylus/*.styl')
        .pipe(stylus({
            linenos: false
        }))
        
        .pipe(concatCss('styl.css'))
        .pipe(gulp.dest('./public/build/')); 

});