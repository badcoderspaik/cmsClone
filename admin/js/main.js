$(function () {
  var form_notification = new APP.Widget.Notification.CheckForm({
      color: "yellow",
      fontSize: "larger",
      boxShadow: "-5px 5px 10px gray",
      duration: 1000,
      borderRadius: "5px"
    }),

    add_content_form = $("form[name='add_content_form']");

  form_notification.append();

  add_content_form.validate(
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

    }, function () {
      var form_data_loader = new APP.FormDataLoader({
        url: "../admin/modules/add_content_form.php",
        form_element: $("#add_content_form"),
        success: function (content) {
          form_notification.content(content);
          form_notification.hide();
        },
        beforeSend: function () {
          form_notification.show("Обработка данных...");
        }
      });
    }
  );


});
