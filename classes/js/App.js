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
  /**
   * вернуть объект APP
   */
  return app;

}(APP || {}));
