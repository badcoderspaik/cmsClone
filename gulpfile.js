var gulp = require('gulp'),
  concat = require('gulp-concat'),
  browser_sync = require('browser-sync'),
  reload = browser_sync.reload,

  tasks = [
    'concat'
  ],

  paths = {
    js: './classes/js/**/*.js',
    css: './**/*.css'
  };

gulp.task('concat', function () {
  return gulp.src([
    "./classes/js/App.js",
    "./classes/js/widgets/Widget.js",
    "./classes/js/widgets/notifications/Notification.js",
    "./classes/js/widgets/notifications/CheckForm.js",
    "./classes/js/net/Net.js",
    "./classes/js/net/FormDataLoader.js"
  ])
    .pipe(concat("classes.js"))
    .pipe(gulp.dest('./classes/js/'));
});

gulp.task('reload', function () {
  var path = ['./**/*.css'];
  browser_sync.init(path, {
    server: {
      baseDir: './'
    }
  });
});

gulp.task('watch', tasks, function () {
  gulp.watch(paths.js, ['concat']);
/*  gulp.watch(paths.css, ['reload']);*/
});