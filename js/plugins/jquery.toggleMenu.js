/*Плагин раскрывающегося меню-слайдера
 * применяется к кнопке меню, появляющейся при уменьшении экрана
 * в качестве параметра методу нужно передать options.target - обернутый элемент,
 * который и будет раскрываться(нет значения по умолчянию);
 * options.speed - скорость анимации - 'slow', 'fast' или значение в мс - 200, 600 и т.д.
 * */
(function ($) {
  $.fn.toggleMenu = function (options) {
    var viewport = $(window),// окно браузера
      width = viewport.width();//ширина окна браузера
    options = $.extend({
      speed: "fast",
      maxW: 700
    }, options);//параметры по умолчанию

    /*при клике на элементе происходит раскр.-закр. элемента options.target
     * если вернуть окно браузера в исходное положение(шире заданного) - сработает
     * метод viewport.resize, который удалит атрибут style элемнета options.target,
     * что предотвратит исчезновение элемента меню при возвращении экрана к исходному размеру
     * */
    return this.on("click", function () {
      options.target.slideToggle(options.speed);
      viewport.resize(function () {
        if (width > options.maxW && options.target.is(":hidden")) options.target.removeAttr("style");
      });
    });
  }
}(jQuery));