/**
 * Created by Александр on 27.05.2017.
 */
/*Главный файл*/
$(function () {
  /*установка плагина раскрывающегося меню на элемент меню*/
  var btnMenu = $(".gamburger"),
    menu_block = $(".sidebar-block");
  btnMenu.toggleMenu({target: menu_block, speed: "fast"});

  $(".menu-button").toggleMenu({target: menu_block});

  var comment_form = $("form[name='comment_form']"),
    form_notification = new APP.Widget.Notification.CheckForm({
      color: "yellow",
      fontSize: "larger",
      boxShadow: "-5px 5px 10px gray",
      duration: 1000,
      borderRadius: "5px"
    });
  form_notification.append();

  comment_form.validate(
    {
      author: {
        required: true,
        messages: {
          empty: "Поле имени не может быть пустым!",
          maxLength: "Имя не должно превышать 20 символов",
        },
        maxLength: 20,
      },

      comment: {
        required: true,
        messages: {
          empty: "Поле комментария не может быть пустым!",
          maxLength: "Комментарий не должен превышать 200 символов",
        },
        maxLength: 200,
      }
    }, function () {
      var form_data_loader = new APP.FormDataLoader({
        url: "../modules/add_comment.php",
        form_element: $("form[name='comment_form']"),
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
