/**
 *
 * Gulpfile setup
 *
 * @since 1.0.0
 * @authors Ahmad Awais, @digisavvy, @desaiuditd, @jb510, @dmassiani and @Maxlopez
 * @package neat
 */


// Project configuration
var project         = 'gulptest', // Project name, used for build zip.
    bsurl         = 'local.gulptest.com', // Local Development URL for BrowserSync. Change as-needed.
    bower       = './assets/bower_components/'; // Not truly using this yet, more or less playing right now. TO-DO Place in Dev branch
    build       = './buildtheme/', // Files that you want to package into a zip go here
    buildInclude    = [
                // include common file types
                '**/*.php',
                '**/*.html',
                '**/*.css',
                '**/*.js',
                '**/*.svg',
                '**/*.ttf',
                '**/*.otf',
                '**/*.eot',
                '**/*.woff',
                '**/*.woff2',

                // include specific files and folders
                'screenshot.png',

                // exclude files and folders
                '!node_modules/**/*',
                '!assets/bower_components/**/*',
                '!style.css.map',
                '!assets/js/custom/*',
                '!assets/css/partials/*'

            ];

// Load plugins
    var gulp         = require('gulp'),
        browserSync  = require('browser-sync'), // Asynchronous browser loading on .scss file changes
        reload       = browserSync.reload,
        autoprefixer = require('gulp-autoprefixer'), // Autoprefixing magic
        minifycss    = require('gulp-uglifycss'),
        filter       = require('gulp-filter'),
        uglify       = require('gulp-uglify'),
        imagemin     = require('gulp-imagemin'),
        newer        = require('gulp-newer'),
        rename       = require('gulp-rename'),
        concat       = require('gulp-concat'),
        notify       = require('gulp-notify'),
        mmq          = require('gulp-merge-media-queries'),
        runSequence  = require('gulp-run-sequence'),
        sass         = require('gulp-sass'),
        gulpCopy     = require('gulp-copy'),
        merge        = require('gulp-merge'),
        plugins      = require('gulp-load-plugins')({ camelize: true }),
        ignore       = require('gulp-ignore'), // Helps with ignoring files and directories in our run tasks
        rimraf       = require('gulp-rimraf'), // Helps with removing files and directories in our run tasks
        zip          = require('gulp-zip'), // Using to zip up our packaged theme into a tasty zip file that can be installed in WordPress!
        plumber      = require('gulp-plumber'), // Helps prevent stream crashing on errors
        cache        = require('gulp-cache'),
        sourcemaps   = require('gulp-sourcemaps');





/**
 * Styles
 *
 * Looking at src/sass and compiling the files into Expanded format, Autoprefixing and sending the files to the build folder
 *
 * Sass output styles: https://web-design-weekly.com/2014/06/15/different-sass-output-styles/
*/
gulp.task('styles', function () {
    gulp.src('./assets/src/sass/main.scss')
        .pipe(sass({
            includePaths: [
                './node_modules/bootstrap/scss/',
            ],
        }))
        .pipe(plumber())
        .pipe(sourcemaps.init())
        .pipe(sass({
            errLogToConsole: true,

            //outputStyle: 'compressed',
            outputStyle: 'compact',
            // outputStyle: 'nested',
            // outputStyle: 'expanded',
            precision: 10
        }))
        .pipe(sourcemaps.write({includeContent: false}))
        .pipe(sourcemaps.init({loadMaps: true}))
        .pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
        .pipe(sourcemaps.write('.'))
        .pipe(plumber.stop())
        .pipe(gulp.dest('./assets/dist/css/'))
        .pipe(filter('**/*.css')) // Filtering stream to only css files
        .pipe(mmq()) // Combines Media Queries
        .pipe(reload({stream:true})) // Inject Styles when style file is created
        .pipe(rename({ suffix: '.min' }))
        .pipe(minifycss({
            maxLineLen: 80
        }))
        .pipe(gulp.dest('./assets/dist/css/'))
        .pipe(reload({stream:true})) // Inject Styles when style file is created

        .pipe(notify({ message: 'Styles task complete', onLast: true }))
});


/**
 * Scripts: Plugins
 *
 * Look at src/js/plugins and concatenate those files, send them to assets/dist/js where we then minimize the concatenated file.
*/
gulp.task('pluginsJs', function() {
    return  gulp.src(['./assets/src/js/plugins/*.js', '!./assets/src/js/plugins/modernizr-3.0.0.min.js', '!./assets/src/js/customizer/theme-customizer.min.js'])
        .pipe(concat('plugins.js'))
        .pipe(gulp.dest('./assets/dist/js/'))
        .pipe(rename( {
            basename: "plugins",
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(gulp.dest('./assets/dist/js/'))
        .pipe(notify({ message: 'Plugin scripts task complete', onLast: true }))
        .pipe(browserSync.stream({once: true}));
});

/**
 * Scripts: Main
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/

gulp.task('scriptsJs', function() {
    return  gulp.src('./assets/src/js/main.js')
        .pipe(concat('main.js'))
        .pipe(gulp.dest('./assets/dist/js/'))
        .pipe(rename( {
            basename: "main",
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(gulp.dest('./assets/dist/js/'))
        .pipe(notify({ message: 'Main scripts task complete', onLast: true }))
        .pipe(browserSync.stream({once: true}));
});

/**
 * Scripts: Main
 *
 * Look at src/js and concatenate those files, send them to assets/js where we then minimize the concatenated file.
*/

gulp.task('customizerJs', function() {
    return  gulp.src('./assets/src/js/customizer/theme-customizer.js')
        .pipe(concat('theme-customizer.js'))
        .pipe(gulp.dest('./assets/dist/js/customizer/'))
        .pipe(rename( {
            basename: "theme-customizer",
            suffix: '.min'
        }))
        .pipe(uglify())
        .pipe(gulp.dest('./assets/dist/js/customizer/'))
        .pipe(notify({ message: 'Customizer scripts task complete', onLast: true }))
        .pipe(browserSync.stream({once: true}));
});

/**
 * Images
 *
 * Look at src/images, optimize the images and send them to the appropriate place
*/
gulp.task('images', function() {

// Add the newer pipe to pass through newer images only
    return  gulp.src(['./assets/src/img/raw/**/*.{png,jpg,gif}'])
        .pipe(newer('./assets/src/img/'))
        .pipe(rimraf({ force: true }))
        .pipe(imagemin({ optimizationLevel: 7, progressive: true, interlaced: true }))
        .pipe(gulp.dest('./assets/dist/img/'))
        .pipe( notify( { message: 'Images task complete', onLast: true } ) );
});

// Copy
gulp.task('copy', function() {
  var modernizr = gulp.src('./assets/src/js/plugins/modernizr-3.0.0.min.js')
    .pipe(gulp.dest('./assets/dist/plugins'));
  var fontawesome = gulp.src('./node_modules/@fortawesome/fontawesome-pro/**/*')
    .pipe(gulp.dest('./assets/dist/plugins/fontawesome-pro'));
  var swiper = gulp.src('./node_modules/swiper/dist/**/*')
    .pipe(gulp.dest('./assets/dist/plugins/swiper'));
  var bootstrap = gulp.src('./node_modules/bootstrap/dist/**/*')
    .pipe(gulp.dest('./assets/dist/plugins/bootstrap'));
  var scrollmagic = gulp.src('./node_modules/scrollmagic/scrollmagic/minified/**/*')
    .pipe(gulp.dest('./assets/dist/plugins/scrollmagic'));
  return merge(modernizr, fontawesome, swiper, bootstrap, scrollmagic);
});

/**
 * Clean gulp cache
 */
 gulp.task('clear', function () {
   cache.clearAll();
 });


  /**
   * Clean tasks for zip
   *
   * Being a little overzealous, but we're cleaning out the build folder, codekit-cache directory and annoying DS_Store files and Also
   * clearing out unoptimized image files in zip as those will have been moved and optimized
  */

  gulp.task('cleanup', function() {
    return  gulp.src(['**/.sass-cache','**/.DS_Store'], { read: false }) // much faster
                .pipe(ignore('node_modules/**')) //Example of a directory to ignore
                .pipe(rimraf({ force: true }))
                // .pipe(notify({ message: 'Clean task complete', onLast: true }));
  });
  gulp.task('cleanupFinal', function() {
    return  gulp.src(['**/.sass-cache','**/.DS_Store'], { read: false }) // much faster
                .pipe(ignore('node_modules/**')) //Example of a directory to ignore
                .pipe(rimraf({ force: true }))
                // .pipe(notify({ message: 'Clean task complete', onLast: true }));
  });

 /**
  * Build task that moves essential theme files for production-ready sites
  *
  * buildFiles copies all the files in buildInclude to build folder - check variable values at the top
  * buildImages copies all the images from img folder in assets while ignoring images inside raw folder if any
  */

  gulp.task('buildFiles', function() {
    return  gulp.src(buildInclude)
                .pipe(gulp.dest(build))
                .pipe(notify({ message: 'Copy from buildFiles complete', onLast: true }));
  });


  /**
  * Images
  *
  * Look at src/images, optimize the images and send them to the appropriate place
  */
  gulp.task('buildImages', function() {
    return  gulp.src(['assets/src/img/**/*', '!assets/src/img/raw/**'])
            .pipe(gulp.dest(build+'assets/dist/img/'))
            .pipe(plugins.notify({ message: 'Images copied to buildTheme folder', onLast: true }));
  });



   /**
    * Zipping build directory for distribution
    *
    * Taking the build folder, which has been cleaned, containing optimized files and zipping it up to send out as an installable theme
   */
   gulp.task('buildZip', function () {
    // return   gulp.src([build+'/**/', './.jshintrc','./.bowerrc','./.gitignore' ])
    return  gulp.src(build+'/**/')
        .pipe(zip(project+'.zip'))
        .pipe(gulp.dest('./'))
        .pipe(notify({ message: 'Zip task complete', onLast: true }));
   });


   // ==== TASKS ==== //
   /**
    * Gulp Default Task
    *
    * Compiles styles, fires-up browser sync, watches js and php files. Note browser sync task watches php files
    *
   */

   // Package Distributable Theme
   gulp.task('build', function(cb) {
    runSequence('styles', 'cleanup', 'pluginsJs', 'scriptsJs', 'customizerJs', 'buildFiles', 'buildImages', 'buildZip','cleanupFinal', cb);
   });


   // Watch
   gulp.task('watch', function() {
        var files = [
                        './**/*.php',
                        './**/*.{png,jpg,gif}'
                    ];
        browserSync.init(files, {

            // Read here http://www.browsersync.io/docs/options/
            proxy: bsurl,

            // port: 8080,

            // Tunnel the Browsersync server through a random Public URL
            // tunnel: true,

            // Attempt to use the URL "http://my-private-site.localtunnel.me"
            // tunnel: 'mylocaltest',

            // Inject CSS changes
            injectChanges: true


        });
        gulp.watch('./assets/src/img/raw/**/*.{png,jpg,gif}', ['images']);
        gulp.watch('./assets/src/sass/**/*.scss', ['styles']);
        gulp.watch('./assets/src/js/**/*.js', ['scriptsJs', 'pluginsJs', 'customizerJs']);

   });


   gulp.task('default', ['styles', 'pluginsJs', 'scriptsJs', 'customizerJs', 'images', 'copy', 'watch']);
