// Load our plugins
var gulp = require( 'gulp' ),
	sass = require( 'gulp-sass' ),  // Our sass compiler
	notify = require( 'gulp-notify' ), // Basic gulp notification using OS
	sourcemaps = require( 'gulp-sourcemaps' ), // Sass sourcemaps
	autoprefixer = require( 'gulp-autoprefixer' ), // Adds vendor prefixes for us
	svgSprite = require( 'gulp-svg-sprite' ),
	svgmin = require( 'gulp-svgmin' ),
	size = require( 'gulp-size' ),
	browserSync = require( 'browser-sync' ), // Sends php, js, and css updates to browser for us
	concat = require( 'gulp-concat' ), // Concat our js
	uglify = require( 'gulp-uglify' ),
	babel = require( 'gulp-babel' ),
	del = require( 'del' ),
	rename = require( 'gulp-rename' ),
	argv = require('yargs').argv, //Arguments parser
    gulpif = require('gulp-if'); //Conditional logic;

////////////////////////////////////////////////////////////////////////////////
// Path Configs
////////////////////////////////////////////////////////////////////////////////

var paths = {
	sassPath: 'assets/sass/',
	nodePath: 'node_modules/',
	jsPath: 'assets/js/concat',
	destPath: 'assets/dist/',
	foundationJSpath: 'node_modules/foundation-sites/js/',
	imgPath: 'assets/img/'
};

var bsProxy = 'localhost';


////////////////////////////////////////////////////////////////////////////////
// SVG Sprite Task
////////////////////////////////////////////////////////////////////////////////

// Delete compiled SVGs before creating a new one
gulp.task('clean:svgs', function () {
  return del([
		paths.destPath + 'svg/**/*',
		paths.destPath + 'sprite/sprite.svg',
	]);
});

var svgConfig = {
	mode: {
		symbol: { // symbol mode to build the SVG
			dest: 'sprite', // destination folder
			sprite: 'sprite.svg', //sprite name
			example: false // Build sample page
		}
	},
	svg: {
		xmlDeclaration: false, // strip out the XML attribute
		doctypeDeclaration: false, // don't include the !DOCTYPE declaration
		rootAttributes: { // add some attributes to the <svg> tag
			width: 0,
			height: 0,
			style: 'position: absolute;'
		}
	}
};

gulp.task('svg-min', ['clean:svgs'], function() {
	return gulp.src(paths.imgPath + 'svg/**/*.svg')
		.pipe(svgmin())
		.pipe(gulp.dest(paths.destPath + 'svg'))
		.pipe(notify({
			message: "✔︎ SVG Minify task complete",
			onLast: true
		}));
});

gulp.task('svg-sprite', ['svg-min'], function() {
  return gulp.src([
		paths.imgPath + 'svg/*.svg'
	])
    .pipe(svgSprite(svgConfig))
    .pipe(gulp.dest(paths.destPath))
		.pipe(browserSync.reload({stream:true}))
		.pipe(notify({
			message: "✔︎ SVG Sprite task complete",
			onLast: true
		}));
});


////////////////////////////////////////////////////////////////////////////////
// Our browser-sync task
////////////////////////////////////////////////////////////////////////////////

gulp.task('browser-sync', function() {
	var files = [
		'**/*.php'
	];

	browserSync.init(files, {
		proxy: bsProxy
	});
});


////////////////////////////////////////////////////////////////////////////////
// CSS
////////////////////////////////////////////////////////////////////////////////

gulp.task('css', function() {
	gulp.src(paths.sassPath + 'app.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'})
			.on('error', notify.onError(function(error) {
				return "Error: " + error.message;
			}))
		)
		.pipe(autoprefixer({ browsers: ['last 2 versions'] }))
		.pipe(rename('app.min.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(size({showFiles: true}))
		.pipe(gulp.dest(paths.destPath + 'css'))
		.pipe(browserSync.stream({match: '**/*.css'}))
		.pipe(notify({
			message: "✔︎ CSS task complete",
			onLast: true
		}));
});


////////////////////////////////////////////////////////////////////////////////
// Login CSS
////////////////////////////////////////////////////////////////////////////////

gulp.task('login-css', function() {
	gulp.src(paths.sassPath + 'login.scss')
		.pipe(sourcemaps.init())
		.pipe(sass({outputStyle: 'compressed'})
			.on('error', notify.onError(function(error) {
				return "Error: " + error.message;
			}))
		)
		.pipe(autoprefixer({ browsers: ['last 2 versions'] }))
		.pipe(rename('login.min.css'))
		.pipe(sourcemaps.write('.'))
		.pipe(size({showFiles: true}))
		.pipe(gulp.dest(paths.destPath + 'css'))
		.pipe(browserSync.stream({match: '**/*.css'}))
		.pipe(notify({
			message: "✔︎ Login CSS task complete",
			onLast: true
		}));
});

////////////////////////////////////////////////////////////////////////////////
// JS
////////////////////////////////////////////////////////////////////////////////

gulp.task('js', function() {
	return gulp.src(paths.jsPath + '**/*.js')
		.pipe(concat('app.js'))
		.pipe(gulp.dest(paths.destPath + 'js'))
		.pipe(uglify().on('error', notify.onError(function(error) {
			return "Error: " + error.message;
			}))
		)
		.pipe(rename('app.min.js'))
		.pipe(gulp.dest(paths.destPath + 'js'))
		.pipe(browserSync.reload({stream:true}))
		.pipe(notify({ message: "✔︎ JS task complete"}));
});


////////////////////////////////////////////////////////////////////////////////
// Foundation JS task, which gives us flexibility to choose what plugins we want
////////////////////////////////////////////////////////////////////////////////

gulp.task('foundation-js', function() {
	return gulp.src([

		/* Choose what JS Plugin you'd like to use. Note that some plugins also
		require specific utility libraries that ship with Foundation—refer to a
		plugin's documentation to find out which plugins require what, and see
		the Foundation's JavaScript page for more information.
		http://foundation.zurb.com/sites/docs/javascript.html */

		// Core Foundation - needed when choosing plugins ala carte
		paths.foundationJSpath + 'foundation.core.js',
		paths.foundationJSpath + 'foundation.util.mediaQuery.js',

		// Choose the individual plugins you want in your project
		paths.foundationJSpath + 'foundation.abide.js',
		paths.foundationJSpath + 'foundation.accordion.js',
		paths.foundationJSpath + 'foundation.accordionMenu.js',
		paths.foundationJSpath + 'foundation.drilldown.js',
		paths.foundationJSpath + 'foundation.dropdown.js',
		paths.foundationJSpath + 'foundation.dropdownMenu.js',
		paths.foundationJSpath + 'foundation.equalizer.js',
		paths.foundationJSpath + 'foundation.interchange.js',
		paths.foundationJSpath + 'foundation.magellan.js',
		paths.foundationJSpath + 'foundation.offcanvas.js',
		paths.foundationJSpath + 'foundation.orbit.js',
		paths.foundationJSpath + 'foundation.responsiveMenu.js',
		paths.foundationJSpath + 'foundation.responsiveToggle.js',
		paths.foundationJSpath + 'foundation.reveal.js',
		paths.foundationJSpath + 'foundation.slider.js',
		paths.foundationJSpath + 'foundation.sticky.js',
		paths.foundationJSpath + 'foundation.tabs.js',
		paths.foundationJSpath + 'foundation.toggler.js',
		paths.foundationJSpath + 'foundation.tooltip.js',
		paths.foundationJSpath + 'foundation.util.box.js',
		paths.foundationJSpath + 'foundation.util.keyboard.js',
		paths.foundationJSpath + 'foundation.util.motion.js',
		paths.foundationJSpath + 'foundation.util.nest.js',
		paths.foundationJSpath + 'foundation.util.timerAndImageLoader.js',
		paths.foundationJSpath + 'foundation.util.touch.js',
		paths.foundationJSpath + 'foundation.util.triggers.js',
		paths.foundationJSpath + 'foundation.zf.responsiveAccordionTabs.js'
	])
	.pipe(babel({
		presets: ['es2015']
	}))
	.pipe(concat('foundation.js'))
	.pipe(gulp.dest(paths.destPath + 'js'))
	.pipe(uglify())
	.pipe(rename('foundation.min.js'))
	.pipe(gulp.dest(paths.destPath + 'js'));
});

// Our 'fonts' task, which handles our sass actions such as compliling and minification
gulp.task('fonts', function() {
		
		//Copy web fonts to dist folder
		gulp.src('./assets/fonts/**/*')
			.pipe(gulp.dest('./assets/dist/fonts'));

		gulp.src('./node_modules/font-awesome/scss/**/*.scss')
			.pipe(sourcemaps.init())
			.pipe(sass({outputStyle: 'compressed'})
				.on('error', notify.onError(function(error) {
					return "Error: " + error.message;
				}))
			)
			.pipe(autoprefixer({ browsers: ['last 2 versions'] }))
			.pipe(rename('font-awesome.min.css'))
			.pipe(sourcemaps.write('.'))
			.pipe(size({showFiles: true}))
			.pipe(gulp.dest(paths.destPath + 'css'))
			.pipe(browserSync.stream({match: '**/*.css'}))
			.pipe(notify({
				message: "✔︎ Fonts task complete",
				onLast: true
			}));
});

//Our 'deploy' task which deploys on a local dev environment
gulp.task('deploy', function() {

	var files = [
		'assets/components/modernizr/modernizr.js',
		'assets/components/fastclick/lib/fastclick.js',
		'node_modules/underscore/underscore-min.js',
		'node_modules/foundation-sites/dist/**/*', 
		'assets/dist/**/*', 
		'assets/js/**/*.js',
		'woocommerce/**/*.*',
		'languages/**.*',
		'page-templates/**/*',
		'src/**/*',
		'template-parts/**/*',
		'screenshot.png',
		'*.php',
		'*.css'];

	var destThemeDev = 'C:/wamp/www/theme-dev/wp-content/themes/dessertstorm';
	var destCanvas = 'C:/wamp/www/canvas/wp-content/themes/dessertstorm';

	return gulp.src(files, {base:"."})
    		.pipe(gulpif(argv.canvas, gulp.dest(destCanvas), gulp.dest(destThemeDev)))
    		.pipe(notify({
				message: "✔︎ Deploy task complete",
				onLast: true
			}));
});


////////////////////////////////////////////////////////////////////////////////
// Watch our files and fire off a task when something changes
////////////////////////////////////////////////////////////////////////////////

// Watch our files and fire off a task when something changes
gulp.task('watch', function() {
	gulp.watch(paths.sassPath + '**/*.scss', ['css']);
	gulp.watch(paths.jsPath + '**/*.js', ['js']);
	gulp.watch(paths.imgPath + 'svg/**/*.svg', ['svg-sprite']);
});

// Full gulp build, including server + watch
gulp.task('serve', ['svg-sprite', 'css', 'js', 'browser-sync', 'foundation-js', 'watch']);

// Our default gulp task, which runs a one-time task
gulp.task('default', ['css', 'js', 'svg-sprite']);
