var gulp = require('gulp'),
  concat = require('gulp-concat'),

  tasks = [
    'concat'
  ],

  paths = {
    root: './classes/js/**/*.js'
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

gulp.task('watch', tasks, function () {
  gulp.watch(paths.root, ['concat']);
});