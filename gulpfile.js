// gulp components
const gulp = require('gulp');
const $ = require('gulp-load-plugins')({
	lazy: true,
	rename: {
		'gulp-wp-cache-bust' : 'wpcachebust'
	}
});
const browserSync = require('browser-sync').create();
const reload = browserSync.reload;

// generic JS components
const jsstylish = require('jshint-stylish');
const imageminJpegRecompress = require('imagemin-jpeg-recompress');
const imageminPngcrush = require('imagemin-pngcrush');

// default task
gulp.task('default', function() {
	console.log('Gulp is up and running');
});

/******
*
* CSS / Stylus Tasks
*
******/

// lint the stylus files
gulp.task('vet-stylus', function() {
	return gulp.src('./src/styl/**/*.styl')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.stylint())
		.pipe($.stylint.reporter())
		.pipe($.stylint.reporter('fail')); // the gulp-process should fail if there are linting errors

		cb(err);
});

// compile the stylus files into style.css && set up sourcemaps
// files must pass linting before they will compile
gulp.task('compile-stylus', ['vet-stylus'], function() {
	return gulp.src('./src/styl/style.styl')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init()) // using external sourcemap
		.pipe($.stylus({}))
		.pipe($.sourcemaps.write('.')) // write to sourcemap
		.pipe(gulp.dest('./assets/css'));

		cb(err);
});

// autoprefix the CSS file
gulp.task('autoprefix-css', ['compile-stylus'],function() {
	return gulp.src('./assets/css/style.css')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init())
		.pipe($.autoprefixer({
			browsers: ['last 8 versions']
		}))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/css'));

		cb(err)
});

// minify the CSS file
// this will vet + compile from stylus before minifying
gulp.task('minify-css', ['autoprefix-css'], function() {
	return gulp.src('./assets/css/style.css')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.cssmin())
		.pipe(gulp.dest('./assets/css'));

		cb(err);
});

// master CSS task to do all CSS tasks
gulp.task('master-css', ['minify-css']);

/******
*
* Javascript Tasks
*
******/

// lint javascript
gulp.task('lint-javascript', function() {
	return gulp.src('./src/js/theme/**/*.js')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.jshint())
		.pipe($.jshint.reporter(jsstylish, {verbose: true}))
		.pipe($.jshint.reporter('fail')); // the gulp-process should fail if there are linting errors

		cb(err);
});

// compile javascript && set up sourcemaps
gulp.task('compile-javascript', ['lint-javascript'], function() {
	return gulp.src(['./src/js/vendor/**/*.js', './src/js/theme/01/_helpers.js', './src/js/theme/01/**/*.js', './src/js/theme/02/**/*.js', './src/js/theme/03/**/*.js'])
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init())
		.pipe($.concat('scripts.js'))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/js'));

		cb(err);
});

// run babel (or similar)
gulp.task('transpile-javascript', ['compile-javascript'], function() {
	return gulp.src('./assets/js/scripts.js')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init())
		.pipe($.babel({
			presets: ['es2015']
		}))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest('./assets/js'));

		cb(err);
});

// minify/uglify javascript
gulp.task('compress-javascript', ['transpile-javascript'], function() {
	return gulp.src('./assets/js/scripts.js')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.uglify())
		.pipe(gulp.dest('./assets/js'));

		cb(err);
});

// master JS task to do all JS tasks
gulp.task('master-js', ['compress-javascript']);

/******
*
* Performance - Misc.
*
******/

// image optimization
gulp.task('compress-images', function() {
	return gulp.src('./src/img/*')
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.cache(
			$.imagemin(
				[
					$.imagemin.gifsicle(), 
					imageminJpegRecompress(), 
					imageminPngcrush(),
					$.imagemin.svgo()
				], {
					verbose: true
				}
		)))
		.pipe(gulp.dest('./assets/img'));

		cb(err);
});

// cache busting
gulp.task('bust-cache', ['compress-javascript', 'minify-css'], function() {
	return gulp.src('functions.php')
		.pipe($.wpcachebust({
			themeFolder: './',
			rootPath: './'
		}))
		.pipe(gulp.dest('./'))
});

/******
*
* Browsersync + Watch Tasks
*
******/

// need watch tasks to make sure browser is reloaded AFTER the file prep is done
gulp.task('js-watch', ['transpile-javascript'], function(done) {
	browserSync.reload();
	done();
});

gulp.task('stylus-watch', ['autoprefix-css'], function(done) {
	browserSync.reload();
	done();
});

gulp.task('img-watch', ['compress-images'], function(done) {
	browserSync.reload();
	done();
});

// master 'watch' task to monitor all static assets for updates and run the appropriate function(s)
gulp.task('watch', ['transpile-javascript', 'autoprefix-css', 'compress-images'], function() {
	browserSync.init({
		proxy: 'localhost:8888'
	});

	gulp.watch('./src/styl/**/*.styl', ['stylus-watch']);
	gulp.watch('./src/js/**/*.js', ['js-watch']);
	gulp.watch('./src/img/*', ['img-watch']);
	gulp.watch('./**/*.php').on('change', browserSync.reload);
});

/******
*
* Dev && Build Scripts
*
******/

// dev script to monitor files, update as needed, and refresh the browser
// just an alias of 'watch' for familiarity of naming conventions
gulp.task('dev', ['watch'])


// build script to prep all files for deployment
gulp.task('build', ['bust-cache', 'compress-images'])

/******
*
* Utility Functions
*
******/

// error handler for any errors occurring while using gulp-plumber
const plumberErrorHandler = {
	errorHandler: $.notify.onError({ // use gulp-notify to send system notifications w/ error messages so that terminal doesn't have to be open to see issues
		title: 'Gulp',
		message: 'Error: <%= error.message %>'
	})
};