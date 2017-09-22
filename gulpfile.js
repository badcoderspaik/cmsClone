var gulp = require('gulp'),
  docco = require('gulp-docco'),

  tasks = [
    'docco'
  ],

  paths = {
    root: './**/*.php'
  };

gulp.task('docco', function () {
  return gulp.src(paths.root)
    .pipe(docco())
    .pipe(gulp.dest('documentation'));
});

gulp.task('watch', tasks, function () {
  gulp.watch(paths.root, ['docco']);
});