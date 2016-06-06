var gulp = require('gulp'),
	source = require('./source.js').returnSource,
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	watch = require('gulp-watch');

gulp.task('js', function() {
	return gulp.src(source()) 
	.pipe(concat('bundle.min.js')) 
	.pipe(uglify()) 
	.pipe(gulp.dest('./public/prodaction/')); 
});

gulp.task('watch', function() {
    gulp.watch("./public/js/*.js", ['js']);
    gulp.watch("./public/js/_components/*.js", ['js']);
}); 