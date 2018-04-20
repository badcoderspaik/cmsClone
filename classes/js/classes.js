/**
 * Класс настроек расширения
 * @class APP
 */
var APP = (function (app) {
  /**
   * Создает пространство имен (вложенные объекты) из параметра items
   * @method APP.namespace
   * @param {string} items Разделенная пробелами строка
   */
  app.namespace = function (items) {
    /**
     * Массив объектов родительского объекта APP, созданный из параметра items метода APP.namespace
     * @private
     * @property parts
     * @type {Array}
     * @default none
     */
    var parts = items.split('.'),
      /**
       * ссылка на APP
       * @private
       * @property parent
       * @type APP
       */
      parent = app,
      i;
    /**
     * если 1ый элемент массива parts == 'APP', то вырезать его
     */
    if (parts[0] === 'APP') {
      parts = parts.slice(1);
    }
    /**
     * для каждого элемента массива
     */
    for (i = 0; i < parts.length; i++) {
      /**
       * если свойство в APP не найдено, создать его и проинициализировать пустым объектом
       */
      if (typeof parent[parts[i]] === 'undefined') {
        parent[parts[i]] = {};
      }
      /**
       * перезаписать объект APP с добалением новых свойств
       */
      parent = parent[parts[i]];
    }

  };
  /**
   * Создает объекты, яляющиеся свойствами объекта APP из параметра items
   * @method APP.items
   * @param {String} items разделенная пробелами строка
   */
  app.items = function (items) {

    var parts = items.split(' '),
      parent = app,
      i;

    if (parts[0] === 'APP') {
      parts = parts.slice(1);
    }
    /**
     * для каждого элемента массива
     */
    for (i = 0; i < parts.length; i++) {
      /**
       * если свойство в APP не найдено, создать его, проинициализировать пустым объектом,
       * и добавить в объект APP
       */
      if (typeof parent[parts[i]] === 'undefined') {
        parent[parts[i]] = {};
      }
    }

  };

  app.inherit = function (child, parent) {
    child.prototype = new parent();
  };
  /**
   * вернуть объект APP
   */
  return app;

}(APP || {}));

APP.Widget = {

  append: function ($context) {
    $context = $context || $('body');
    $context.append(this.element);
  }
};

APP.Widget.Notification = function (options) {
  var options = options || {},
  that = this;
  this.element = options.element || $("<div>");
  this.content = options.content || "";
  this.element.text(this.content);

  var width = options.width || "",
    marginLeft = options.marginLeft || -(parseInt(width) / 2) + "px",
    padding = options.padding || "10px",
    position = options.position || "fixed",
    left = options.left || "50%",
    top = options.top || "50px",
    marginTop = options.marginTop || "10px",
    display = "none",
    backgroundColor = options.backgroundColor || "blue",
    color = options.color || "white",
    textAlign = options.textAlign || "center",
    borderRadius = options.borderRadius || "5px",
    opacity = options.opacity || 1,
    fontSize = options.fontSize || "",
    boxShadow = options.boxShadow || "",
    duration = options.duration || 2000;

  this.element.css({
    width: width,
    marginLeft: marginLeft,
    padding: padding,
    position: position,
    left: left,
    top: top,
    marginTop: marginTop,
    backgroundColor: backgroundColor,
    color: color,
    textAlign: textAlign,
    borderRadius: borderRadius,
    display: display,
    opacity: opacity,
    fontSize: fontSize,
    boxShadow: boxShadow
  });

  this.show = function (content) {
    var that = this;
    if (content) this.element.text(content);
    this.element.fadeIn('slow');
    return this.element;
  };

  this.hide = function () {
    var that = this;
    setTimeout(function () {
      that.element.fadeOut('slow');
    }, duration);
    return that.element;
  };

  this.content = function (content) {
    if(!content) return content;
    else this.element.text(content);
  };

  this.element.on("mouseover", function () {
    that.hide();
  });

};

APP.Widget.Notification.prototype = APP.Widget;
APP.Widget.Notification.CheckForm = function (options) {
  APP.Widget.Notification.apply(this, arguments);
};

APP.inherit(APP.Widget.Notification.CheckForm, APP.Widget.Notification);
APP.Net = {

};
APP.FormDataLoader = function (options) {
  var options = options || {},
    url = options.url || "",
    type = options.type || "post",
    form_element = options.form_element,
    success = options.success,
    error = options.error ||function () {
        alert("Ошибка сети");
      },
    beforeSend = options.beforeSend;

  this.query = function () {
    var formData = new FormData(form_element[0]);
    $.ajax({
      url: url,
      type: type,
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      success: success,
      beforeSend: beforeSend,
      error: error
    });
  };


  /*form_element.on("submit", function (event) {
    var formData = new FormData(form_element[0]);
    $.ajax({
      url: url,
      type: type,
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      success: success,
      beforeSend: beforeSend,
      error: error
    });
  });*/

};

APP.FormDataLoader.prototype = APP.Net;