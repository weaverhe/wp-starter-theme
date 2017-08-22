'use strict';

// Required Components
var gulp = require('gulp');
var concat = require('gulp-concat');
var jshint = require('gulp-jshint');
var stylish = require('jshint-stylish');
var imagemin = require('gulp-imagemin');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var sync = require('browser-sync').create();
var minify = require('gulp-cssnano');
var uglify = require('gulp-uglify');
var prefixer = require('gulp-prefix');
var stylus = require('gulp-stylus');
var sourcemaps = require('gulp-sourcemaps');

// Default task for debugging
gulp.task('default', function() {
	console.log('gulp running');
});

// Task for development - compiles sass + js, optimizes images, enables browser reload
gulp.task('dev', ['compile-stylus', 'lint-js', 'concat-js', 'img-optim', 'auto-prefix', 'watch']);

// Task to prep files for deployment
gulp.task('build', ['minify-css', 'uglify-js', 'img-optim']);

// Task to compile stylus files
gulp.task('compile-stylus', function() {
	return gulp.src('./src/styl/style.styl')
		.pipe(plumber(plumberErrorHandler))
		.pipe(sourcemaps.init())
		.pipe(stylus({
			
		}))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/css'));
		cb(err);
});

// Task to auto-prefix
gulp.task('auto-prefix', ['compile-stylus'], function() {
	return gulp.src('./assets/css')
	.pipe(prefixer({
		browsers: ['last 40 version'],
		cascade: false
	}))
	.pipe(gulp.dest('./assets/css'));
});

// Task to minify CSS
gulp.task('minify-css', ['auto-prefix'], function() {
	return gulp.src(['./assets/css/style.css'])
		.pipe(minify({}))
		.pipe(gulp.dest('./assets/css'))
		.pipe(sync.stream());
});

// Task to lint + concatenate js files
gulp.task('concat-js', ['lint-js'], function() {
	return gulp.src(['./src/js/vendor/*.js', './src/js/theme/01/*.js', './src/js/theme/02/*.js', './src/js/theme/03/*.js'])
		.pipe(plumber(plumberErrorHandler))
		.pipe(concat('scripts.js'))
		.pipe(gulp.dest('./assets/js'))
		.pipe(sync.stream())
		cb(err);
});

// Task to lint js file
gulp.task('lint-js', function() {
	return gulp.src('./src/js/theme/**/*.js')
		.pipe(plumber(plumberErrorHandler))
		.pipe(jshint())
		.pipe(jshint.reporter(stylish))
		.pipe(jshint.reporter('fail'))
		cb(err);
});

// Task to uglify js file
gulp.task('uglify-js', ['lint-js', 'concat-js'], function() {
	return gulp.src('./assets/js/scripts.js')
		.pipe(plumber(plumberErrorHandler))
		.pipe(uglify())
		.pipe(gulp.dest('./assets/js'));
});

// Task to optimize images
gulp.task('img-optim', function() {
	return gulp.src('./src/img/**/*.{png,jpg,gif,svg}')
		.pipe(plumber(plumberErrorHandler))
		.pipe(imagemin({
			optimizationLevel : 2,
			progressive: true
		}))

		.pipe(gulp.dest('./assets/img'))
		.pipe(sync.stream());
		cb(err);
});

// Task to watch for changes + run function accordingly
gulp.task('watch', ['compile-stylus', 'concat-js', 'lint-js', 'img-optim'], function() {
	sync.init({
		proxy: 'localhost:8888'
	});

	gulp.watch('./src/styl/**/*.styl', ['compile-stylus']);
	gulp.watch(['./src/js/vendor/*.js', './src/js/theme/**/*.js'], ['lint-js', 'concat-js']);
	gulp.watch('./src/img/**/*.{png,jpg,gif,svg}', ['img-optim']);
	gulp.watch('./**/*.php').on('change', sync.reload);
});

// Task to reload browser on page updates
gulp.task('browser-sync', function() {
	sync.init({
		proxy: 'localhost:8888'
	});
});

// Error Handling Function
var plumberErrorHandler = { errorHandler: notify.onError({
		title: 'Gulp',
		message: 'Error: <%= error.message %>'
	})
};
