// gulp components
const gulp = require('gulp');
const $ = require('gulp-load-plugins')({
	lazy: true,
	rename: {
		'gulp-wp-cache-bust': 'wpcachebust',
	},
});
const browserSync = require('browser-sync').create();

// generic JS components
const imageminJpegRecompress = require('imagemin-jpeg-recompress');
const imageminPngcrush = require('imagemin-pngcrush');

// local config
const gConfig = require('./gulp-config');

const { sources, destinations } = gConfig.paths;

/**
 * Utility Tasks & Helper Functions
 *
 * 1. Plumber Error Handler
 */
// error handler for any errors occurring while using gulp-plumber
const plumberErrorHandler = {
	// use gulp-notify to send system notifications w/ error messages.
	// means that terminal doesn't have to be open to see issues
	errorHandler: $.notify.onError({
		title: 'Gulp',
		message: 'Error: <%= error.message %>',
	}),
};

// default task
gulp.task('default', (done) => {
	console.log('Gulp is up and running');
	done();
});

/**
 * CSS & Stylus Tasks
 *
 * 1. Vet Stylus
 * 2. Compile Stylus
 * 3. Autoprefix CSS
 * 4. Minify CSS
 * 5. CSS Master Task (Run All)
 */

// lint the stylus files
gulp.task('vet-stylus', () => (
	gulp.src(sources.stylus)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.stylint())
		.pipe($.stylint.reporter())
		.pipe($.stylint.reporter('fail')) // the gulp-process should fail if there are linting errors
));

// compile the stylus files into style.css, set up sourcemaps
// files must pass linting before they will compile
gulp.task('compile-stylus', gulp.series('vet-stylus', () => (
	gulp.src(sources.stylusM)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init()) // using external sourcemap
		.pipe($.stylus({}))
		.pipe($.sourcemaps.write('.')) // write to sourcemap
		.pipe(gulp.dest('./assets/css'))
)));

// combine media queries & autoprefix the CSS file
gulp.task('autoprefix-css', gulp.series('compile-stylus', () => (
	gulp.src(destinations.cssM)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init())
		.pipe($.autoprefixer({
			browsers: ['last 8 versions'],
		}))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest(destinations.css))
)));

// minify the CSS file
// this will vet + compile from stylus before minifying
gulp.task('minify-css', gulp.series('autoprefix-css', () => (
	gulp.src(destinations.cssM)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.cssmin())
		.pipe(gulp.dest(destinations.css))
)));

// master CSS task to do all CSS tasks
gulp.task('master-css', gulp.parallel('minify-css'));

/**
 * Javascript Tasks
 *
 * 1. Lint JS
 * 2. Compile JS
 * 3. Transpile JS
 * 4. Compress JS
 * 5. Master JS Task (Run All)
 */

// lint javascript
gulp.task('lint-javascript', () => (
	gulp.src(sources.jst)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.eslint())
		.pipe($.eslint.format())
		.pipe($.eslint.failAfterError())
));

// compile javascript && set up sourcemaps
gulp.task('compile-javascript', gulp.series('lint-javascript', () => (
	gulp.src([sources.jsv, sources.jst])
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init())
		.pipe($.concat('scripts.js'))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest(destinations.js))
)));

// run babel (or similar)
gulp.task('transpile-javascript', gulp.series('compile-javascript', () => (
	gulp.src(destinations.jsM)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.sourcemaps.init())
		.pipe($.babel({
			presets: ['@babel/env'],
		}))
		.pipe($.sourcemaps.write('.'))
		.pipe(gulp.dest(destinations.js))
)));

// minify/uglify javascript
gulp.task('compress-javascript', gulp.series('transpile-javascript', () => (
	gulp.src(destinations.jsM)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.uglify())
		.pipe(gulp.dest(destinations.js))
)));

// master JS task to do all JS tasks
gulp.task('master-js', gulp.parallel('compress-javascript'));

/**
 * Performance & Optimization Tasks
 *
 * 1. Image Optimization
 * 2. Cache Busting
 */
// image optimization
gulp.task('compress-images', () => (
	gulp.src(sources.img)
		.pipe($.plumber(plumberErrorHandler))
		.pipe($.cache(
			$.imagemin(
				[
					$.imagemin.gifsicle(),
					imageminJpegRecompress(),
					imageminPngcrush(),
					$.imagemin.svgo(),
				], {
					verbose: true,
				},
			),
		))
		.pipe(gulp.dest(destinations.img))
));

// cache busting
gulp.task('bust-cache', gulp.series('compress-javascript', 'minify-css', () => (
	gulp.src('functions.php')
		.pipe($.wpcachebust({
			themeFolder: './',
			rootPath: './',
		}))
		.pipe(gulp.dest('./'))
)));

/**
 * Browsersync & Watch Tasks
 *
 * 1. JS Watch
 * 2. Stylus Watch
 * 3. Image Watch
 * 4. Master Watch (Run All)
 */
// need watch tasks to make sure browser is reloaded AFTER the file prep is done
gulp.task('js-watch', gulp.series('transpile-javascript', (done) => {
	browserSync.reload();
	done();
}));

gulp.task('stylus-watch', gulp.series('autoprefix-css', (done) => {
	browserSync.reload();
	done();
}));

gulp.task('img-watch', gulp.series('compress-images', (done) => {
	browserSync.reload();
	done();
}));

// master 'watch' task to monitor all static assets for updates and run the appropriate function(s)
gulp.task('watch', gulp.series('transpile-javascript', 'autoprefix-css', 'compress-images', () => {
	browserSync.init({
		proxy: 'localhost:8888',
	});

	gulp.watch(sources.stylus, gulp.series('stylus-watch'));
	gulp.watch(sources.js, gulp.series('js-watch'));
	gulp.watch(sources.img, gulp.series('img-watch'));
	gulp.watch(sources.php).on('change', browserSync.reload);
}));

/**
 * Dev & Build Scripts
 */
// dev script to monitor files, update as needed, and refresh the browser
// just an alias of 'watch' for familiarity of naming conventions
gulp.task('dev', gulp.series('watch'));

// build script to prep all files for deployment
gulp.task('build', gulp.series('bust-cache', 'compress-images'));
