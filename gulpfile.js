var gulp = require('gulp'),
  concat = require('gulp-concat'),
  browser_sync = require('browser-sync'),
  reload = browser_sync.reload,
  js_uncomment = require('gulp-uncomment'),

  tasks = [//таски, которые выполнятся вначале таска watch
    'concat_classes_scripts',
    'concat_global_scripts'
  ],

  paths = {//пути отслеживания в таске watch
    js: './classes/js/**/*.js',
    global_js:'./js/**/*.js',
    css: './**/*.css'
  };

gulp.task('concat_classes_scripts', function () {//таск объединения скриптов классов
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

gulp.task('concat_global_scripts', function () {//таск объединения главных скриптов в один основной
  return gulp.src([
    './js/plugins/jquery.toggleMenu.js',
    './js/plugins/jquery.validate.js',
    './js/main.js'
  ])
    .pipe(js_uncomment({removeEmptyLines:true}))
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest('./js/'));
});

gulp.task('reload', function () {//таск перезагрузки браузера
  var path = ['./**/*.css'];
  browser_sync.init(path, {
    server: {
      baseDir: './'
    }
  });
});

gulp.task('watch', tasks, function () {//watcher
  gulp.watch(paths.js, ['concat_classes_scripts']);
  gulp.watch(paths.global_js, ['concat_global_scripts']);
/*  gulp.watch(paths.styles, ['reload']);*/
});