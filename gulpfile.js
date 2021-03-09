// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var autoprefixer = require( 'autoprefixer' );
var rename       = require( 'gulp-rename' );
var replace      = require( 'gulp-replace' );
var uglify       = require( 'gulp-uglify' );
var rtlcss       = require( 'gulp-rtlcss' );
var sass         = require( 'gulp-sass' );
var postcss      = require( 'gulp-postcss' );
var sorting      = require( 'postcss-sorting' );

// Minify JS
gulp.task( 'minifyjs', function() {
	return gulp.src( ['assets/js/custom-font-control.js', 'assets/js/customize-preview.js', 'assets/js/header-search.js', 'assets/js/scroll-to-top.js'] )
		.pipe( uglify() )
		.pipe( rename( {
			suffix: '.min'
		} ) )
		.pipe( gulp.dest('assets/js') );
});

// Clean up CSS
gulp.task( 'cleancss', function() {
	return gulp.src( ['assets/css/*.css'], { base: './' } )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( postcss( [ sorting( { 'preserve-empty-lines-between-children-rules': true } ) ] ) )
		.pipe( gulp.dest( './' ) );
});

// RTL CSS
gulp.task( 'rtlcss', function () {
	return gulp.src( 'assets/css/poseidon-pro.css' )
		.pipe( rtlcss() )
		.pipe( rename( {
			suffix: '-rtl'
		} ) )
		.pipe( gulp.dest( 'assets/css' ) );
});

// Sass Bundler
gulp.task( 'sass', function() {
    return gulp.src( 'sass/style.scss' )
        .pipe( sass( { outputStyle: 'expanded' } ).on( 'error', sass.logError ) )
		.pipe( rename( 'assets/css/poseidon-pro.css' ) )
		.pipe( postcss( [ sorting() ] ) )
		.pipe( replace( '  ', '	' ) )
		.pipe( replace( '}\n	', '}\n\n	' ) )
		.pipe( replace( '}\n\n	}', '}\n	}' ) )
		.pipe( replace( '*/\n/*', '*/\n\n/*' ) )
		.pipe( replace( ';\n	/*', '; /*' ) )
        .pipe( gulp.dest( './' ) )
});

// Sass Watch
gulp.task('sass:watch', function () {
	gulp.watch( 'sass/**/*.scss', gulp.series('sass'));
});
