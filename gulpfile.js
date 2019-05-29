var gulp = require('gulp'),
  autoprefixer = require('gulp-autoprefixer'),
  browserSync = require('browser-sync'),
  cache = require('gulp-cache'),
  concat = require('gulp-concat'),
  filter = require('gulp-filter'),
  gulpCopy = require('gulp-copy'),
  ignore = require('gulp-ignore'),
  imagemin = require('gulp-imagemin'),
  merge = require('gulp-merge'),
  minifycss = require('gulp-uglifycss'),
  mmq = require('gulp-merge-media-queries'),
  newer = require('gulp-newer'),
  notify = require('gulp-notify'),
  plugins = require('gulp-load-plugins')({camelize: true}),
  plumber = require('gulp-plumber'),
  reload = browserSync.reload,
  rename = require('gulp-rename'),
  rimraf = require('gulp-rimraf'),
  runSequence = require('run-sequence'),
  sass = require('gulp-sass'),
  sourcemaps = require('gulp-sourcemaps'),
  uglify = require('gulp-uglify'),
  zip = require('gulp-zip');

var themeName = 'incredibletheme',
  localSiteUrl = 'incredibletheme.local',
  buildDir = './build/',
  buildInclude = [
    // include all
    '**/*',
    // exclude
    '!node_modules',
    '!node_modules/**/*',
    '!assets/src',
    '!assets/src/**/*',
    '!style.css.map',
    '!.editorconfig',
    '!.jscsrc',
    '!.jshintignore',
    '!build',
    '!build/**/*',
    '!**/*.zip',
    '!.jshintrc',
    '!.npmrc',
    '!README.md',
    '!assets/js/custom/*',
    '!assets/css/partials/*'
  ];

gulp.task('styles', function() {
  gulp
    .src('./assets/src/sass/main.scss')
    .pipe(plumber())
    .pipe(
      sass({
        includePaths: ['./node_modules/bootstrap/scss/']
      })
    )
    .pipe(sourcemaps.init())
    .pipe(
      sass({
        errLogToConsole: true,
        //outputStyle: 'compressed',
        outputStyle: 'compact',
        // outputStyle: 'nested',
        // outputStyle: 'expanded'
        precision: 10
      })
    )
    .pipe(sourcemaps.write({includeContent: false}))
    .pipe(sourcemaps.init({loadMaps: true}))
    .pipe(autoprefixer('last 2 version', '> 1%', 'safari 5', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    .pipe(sourcemaps.write('.'))
    .pipe(plumber.stop())
    .pipe(gulp.dest('./assets/dist/css/'))
    .pipe(filter('**/*.css'))
    .pipe(mmq())
    .pipe(reload({stream: true}))
    .pipe(rename({suffix: '.min'}))
    .pipe(
      minifycss({
        maxLineLen: 80
      })
    )
    .pipe(gulp.dest('./assets/dist/css/'))
    .pipe(reload({stream: true}))
    .pipe(notify({message: 'Styles task complete', onLast: true}));
});

gulp.task('pluginsJs', function() {
  return gulp
    .src(['./assets/src/js/plugins/*.js', '!./assets/src/js/plugins/modernizr-3.0.0.min.js', '!./assets/src/js/customizer/theme-customizer.min.js'])
    .pipe(concat('plugins.js'))
    .pipe(gulp.dest('./assets/dist/js/'))
    .pipe(
      rename({
        basename: 'plugins',
        suffix: '.min'
      })
    )
    .pipe(uglify())
    .pipe(gulp.dest('./assets/dist/js/'))
    .pipe(notify({message: 'Plugin scripts task complete', onLast: true}))
    .pipe(browserSync.stream({once: true}));
});

gulp.task('scriptsJs', function() {
  return gulp
    .src('./assets/src/js/main.js')
    .pipe(concat('main.js'))
    .pipe(gulp.dest('./assets/dist/js/'))
    .pipe(
      rename({
        basename: 'main',
        suffix: '.min'
      })
    )
    .pipe(uglify())
    .pipe(gulp.dest('./assets/dist/js/'))
    .pipe(notify({message: 'Main scripts task complete', onLast: true}))
    .pipe(browserSync.stream({once: true}));
});

gulp.task('customizerJs', function() {
  return gulp
    .src('./assets/src/js/customizer/theme-customizer.js')
    .pipe(concat('theme-customizer.js'))
    .pipe(gulp.dest('./assets/dist/js/customizer/'))
    .pipe(
      rename({
        basename: 'theme-customizer',
        suffix: '.min'
      })
    )
    .pipe(uglify())
    .pipe(gulp.dest('./assets/dist/js/customizer/'))
    .pipe(notify({message: 'Customizer scripts task complete', onLast: true}))
    .pipe(browserSync.stream({once: true}));
});

gulp.task('images', function() {
  return gulp
    .src(['./assets/src/img/raw/**/*.{png,jpg,gif}'])
    .pipe(newer('./assets/src/img/'))
    .pipe(rimraf({force: true}))
    .pipe(imagemin({optimizationLevel: 7, progressive: true, interlaced: true}))
    .pipe(gulp.dest('./assets/dist/img/'))
    .pipe(notify({message: 'Images task complete', onLast: true}));
});

gulp.task('copy', function() {
  var modernizr = gulp.src('./assets/src/js/plugins/modernizr-3.0.0.min.js').pipe(gulp.dest('./assets/dist/plugins'));
  var fontawesomecss = gulp.src('./node_modules/@fortawesome/fontawesome-pro/css/**/*').pipe(gulp.dest('./assets/dist/plugins/fontawesome-pro/css'));
  var fontawesomejs = gulp.src('./node_modules/@fortawesome/fontawesome-pro/js/**/*').pipe(gulp.dest('./assets/dist/plugins/fontawesome-pro/js'));
  var fontawesomewebfonts = gulp.src('./node_modules/@fortawesome/fontawesome-pro/webfonts/**/*').pipe(gulp.dest('./assets/dist/plugins/fontawesome-pro/webfonts'));
  var swiper = gulp.src('./node_modules/swiper/dist/**/*').pipe(gulp.dest('./assets/dist/plugins/swiper'));
  var bootstrap = gulp.src('./node_modules/bootstrap/dist/**/*').pipe(gulp.dest('./assets/dist/plugins/bootstrap'));
  var scrollmagic = gulp.src('./node_modules/scrollmagic/scrollmagic/minified/**/*').pipe(gulp.dest('./assets/dist/plugins/scrollmagic'));
  var gsap = gulp.src('./node_modules/gsap/**/*').pipe(gulp.dest('./assets/dist/plugins/gsap'));
  return merge(modernizr, fontawesomecss, fontawesomejs, fontawesomewebfonts, swiper, bootstrap, scrollmagic, gsap);
});

gulp.task('clear', function() {
  cache.clearAll();
});

gulp.task('clean', function() {
  return gulp
    .src(['**/.sass-cache', '**/.DS_Store'], {read: false})
    .pipe(ignore('node_modules/**'))
    .pipe(rimraf({force: true}));
});

gulp.task('cleanFinal', function() {
  return gulp
    .src(['**/.sass-cache', '**/.DS_Store'], {read: false})
    .pipe(ignore('node_modules/**'))
    .pipe(rimraf({force: true}));
});

gulp.task('buildFiles', function() {
  return gulp
    .src(buildInclude)
    .pipe(gulp.dest(buildDir))
    .pipe(notify({message: 'Copy from buildFiles complete', onLast: true}));
});

gulp.task('buildImages', function() {
  return gulp
    .src(['assets/src/img/**/*', '!assets/src/img/raw/**'])
    .pipe(gulp.dest(buildDir + 'assets/dist/img/'))
    .pipe(plugins.notify({message: 'Images copied to buildTheme folder', onLast: true}));
});

gulp.task('buildZip', function() {
  return gulp
    .src(buildDir + '/**/')
    .pipe(zip(themeName + '.zip'))
    .pipe(gulp.dest('./'))
    .pipe(notify({message: 'Zip task complete', onLast: true}));
});

gulp.task('build', function(cb) {
  runSequence('styles', 'clean', 'pluginsJs', 'scriptsJs', 'customizerJs', 'buildFiles', 'buildImages', 'buildZip', 'cleanFinal', cb);
});

gulp.task('watch', function() {
  var files = ['./**/*.php', './**/*.{png,jpg,gif}'];
  browserSync.init(files, {
    // http://www.browsersync.io/docs/options/
    proxy: localSiteUrl,
    // port: 8080,
    // tunnel: true,
    injectChanges: true
  });
  gulp.watch('./assets/src/img/raw/**/*.{png,jpg,gif}', ['images']);
  gulp.watch('./assets/src/sass/**/*.scss', ['styles']);
  gulp.watch('./assets/src/js/**/*.js', ['scriptsJs', 'pluginsJs', 'customizerJs']);
});

gulp.task('default', ['styles', 'pluginsJs', 'scriptsJs', 'customizerJs', 'images', 'copy', 'watch']);
