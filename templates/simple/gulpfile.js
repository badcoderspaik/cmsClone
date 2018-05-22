var gulp = require('gulp'),
  js_minify = require('gulp-uglify'),//минификатор js
  less = require('gulp-less'),//less препроцессор
  sourcemaps = require('gulp-sourcemaps'),//создает sourcemap для less файлов
  browser_sync = require('browser-sync'),//перезагрузка браузера
  concat = require('gulp-concat'),//объединение файлов
  rename = require('gulp-rename'),//переименование файлов
  plumber = require('gulp-plumber'),
  cssnano = require('gulp-cssnano');//css минификатор

gulp.task('browser-sync', function () {//инициализация browser_sync - создание локального сервера
  browser_sync({
    server: {
      baseDir: './'
    },
    notify: false
  });
});
/**
 * таск для препроцессинга less файлов. Берет все файлы c расширением less
 * (но не lesshat.less, variables.less, mixins.less) из директории src/less/, затем создает для каждого
 * sourcemap файлы, затем создает css файлы, затем все созданные файлы кладет в директорию src/css/
 * и перезагружает браузер
 */
gulp.task('less', function () {
  return gulp.src(['./src/less/**/*.less', '!./src/less/**/lesshat.less', '!./src/less/**/variables.less', '!./src/less/**/mixins.less']).
  pipe(plumber()).
  pipe(sourcemaps.init()).
  pipe(less()).
  pipe(sourcemaps.write('')).
  pipe(gulp.dest('./src/css')).
  pipe(browser_sync.reload({stream: true}));
});
/**
 * таск для минификации css файла сброса стилей - берет файл reset.css из директории src/css/, минифицирует его,
 * добавляет к нему суффикс min и кладет в директорию styles/. В итоге получается файл reset.min.css
 */
gulp.task('cssnano', function () {
  return gulp.src('./src/css/reset.css').
    pipe(cssnano()).
    pipe(rename({suffix: '.min'})).
    pipe(gulp.dest('./styles'));
});
/**
 * таск для копирования css файлов из директории src/css/ в директорию styles/. Это нужно для того, чтобы
 * после препроцессинга less файлов и создания css файлов в директории src/css/ эти же созданные файлы
 * копировались в директорию /styles, т.к. именно из нее происходит чтение стилей страницей
 */
gulp.task('css', function () {
  return gulp.src('./src/css/*.+(css|map)').
    pipe(gulp.dest('./styles'));
});
/**
 * таск объединения js файлов
 */
// gulp.task('concat_scripts', function () {
//   return gulp
// })
/**
 * дефолтный таск: 1.срабатывает browser_sync, запуская сервер и браузер 2. запускается слежение за
 * less файлами, за index.html и за css файлами
 */
gulp.task('default', ['browser-sync'], function (e) {
  gulp.watch('./src/less/**/*.less', ['less']);
  gulp.watch('index.html', browser_sync.reload);
  gulp.watch('./src/css/**/*.css', ['css']);
  gulp.watch('./styles/', browser_sync.reload);
});