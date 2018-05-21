//Основной js файл админ панели
$(function () {

  var btnMenu = $(".gamburger"),//элемент кнопки раскрывающегося меню
    menu_block = $(".sidebar-block");//элемент раскрывающегося меню
  btnMenu.toggleMenu({target: menu_block, speed: "fast"});/*установка плагина раскрывающегося меню на элемент кнопки меню*/

  $(".menu-button").toggleMenu({target: menu_block});//установка плагина раскрывающегося меню на элемент кнопки меню

  var form_notification = new APP.Widget.Notification.CheckForm({//Объект уведомления проверки формы
      color: "yellow",//цвет текста уведомления
      fontSize: "larger",//размер шрифта уведомления
      boxShadow: "-5px 5px 10px gray",//тень
      duration: 1000,//время проказа уведомления
      borderRadius: "5px",//радиус скругления углов уведомления
      left: "10px",
      top: "10px"
    }),

    add_content_form = $("#add_content_form"),//jquery объект формы (desktop вариант) добавления контента из файла add_content_form.html
    mob_add_content_form = $("#mob_add_content_form"),//jquery объект формы (mobile вариант) добавления контента из файла add_content_form.html
    //Объект загрузчика контента на сервер
    form_data_loader = new APP.FormDataLoader({
      url: "../admin/modules/add_content_form.php",//url, куда следует отправить данные формы
      form_element: $("#add_content_form"),// jquery объект формы
      success: function (content) {//функция, которая выполнится в результате удачного ответа сервера
        form_notification.content(content);
        form_notification.hide();
      },
      beforeSend: function () {//функция, которая выполнится перед отправкой данных на сервер
        form_notification.show("Обработка данных...");
      }
    });

  form_notification.append();//добавление уведомления в DOM

  add_content_form.validate(//подключение к форме (десктоп версия) плагина валидации
    {
      book_title: {
        required: true,

        messages: {
          empty: "Название не может быть пустым!",
          minLength: "Название должно содержать более 3х символов!",
          maxLength: "Название не должно превышать 100 символов",
        },

        minLength: 3,
        maxLength: 100,

      },

      autor: {
        required: true,
        minLength: 3,

        messages: {
          empty: "Имя автора не может быть пустым!",
          minLength: "Имя автора должно содержать более 3х символов!"
        }

      },

      year: {
        required: true,

        messages: {
          empty: "Год не может быть пустым!",
          expression: "Год должен быть указан цифрами"
        },

        expression: new RegExp("^\\d+$")

      },

      description: {
        required: true,
        minLength: 3,

        messages: {
          empty: "Описание не может быть пустым!",
          minLength: "Описание должно содержать более 3х символов!"
        }

      },

      cover: {
        required: true,

        messages: {
          empty: "Не выбрана обложка!"
        }

      },

      book_file: {
        required: true,

        messages: {
          empty: "Не выбран файл!"
        }
      }

    }, form_data_loader.query
  );

  mob_add_content_form.validate(//подключение к форме ( mobile верия ) плагина валидации
    {
      book_title: {
        required: true,

        messages: {
          empty: "Название не может быть пустым!",
          minLength: "Название должно содержать более 3х символов!",
          maxLength: "Название не должно превышать 100 символов",
        },

        minLength: 3,
        maxLength: 100,

      },

      autor: {
        required: true,
        minLength: 3,

        messages: {
          empty: "Имя автора не может быть пустым!",
          minLength: "Имя автора должно содержать более 3х символов!"
        }

      },

      year: {
        required: true,

        messages: {
          empty: "Год не может быть пустым!",
          expression: "Год должен быть указан цифрами"
        },

        expression: new RegExp("^\\d+$")

      },

      description: {
        required: true,
        minLength: 3,

        messages: {
          empty: "Описание не может быть пустым!",
          minLength: "Описание должно содержать более 3х символов!"
        }

      },

      cover: {
        required: true,

        messages: {
          empty: "Не выбрана обложка!"
        }

      },

      book_file: {
        required: true,

        messages: {
          empty: "Не выбран файл!"
        }
      }

    }, form_data_loader.query
  );


});
