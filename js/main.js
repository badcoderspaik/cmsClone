/**
 * Created by Александр on 27.05.2017.
 */
/*Главный файл*/
$(function () {

  var btnMenu = $(".mob-menu-button"),//элемент кнопки раскрывающегося меню
    menu_block = $(".menubar__item-block");//элемент раскрывающегося меню
  btnMenu.toggleMenu({target: menu_block, speed: "fast"});/*установка плагина раскрывающегося меню на элемент кнопки меню*/

  $(".menubar__button").toggleMenu({target: menu_block});//установка плагина раскрывающегося меню на элемент кнопки меню

  /*var comment_form = $("form[name='comment_form']"),//форма комментариев к постам из comment_form.html
    form_notification = new APP.Widget.Notification.CheckForm({//объект уведомления проверки формы
      color: "yellow",//цвет текста
      fontSize: "larger",//размер шрифта
      boxShadow: "-5px 5px 10px gray",//тень уведомления
      duration: 1000,//время показа
      borderRadius: "5px",//радиус скругления углов
      left: "10px",
      top: "10px"
    });
  form_notification.append();

  var form_data_loader = new APP.FormDataLoader({//объект отправки контента на сервер
    url: "../modules/add_comment.php",//url, куда уйдут данные формы
    form_element: comment_form,//jquery объект формы комментариев
    success: function (content) {//функция, которая будет выполнена в результае успешного ответа сервера
      form_notification.content(content);
      form_notification.hide();
    },
    beforeSend: function () {//функция, которая будет выполнена перед отправкой данных на сервер
      form_notification.show("Обработка данных...");
    }
  });

  comment_form.validate(//подключение плагина валидации к форме комментариев
    {
      author: {
        required: true,
        messages: {
          empty: "Поле имени обязательно к заполнению!",
          maxLength: "Имя не должно превышать 20 символов",
        },
        maxLength: 20,
      },

      comment: {
        required: true,
        messages: {
          empty: "Поле комментария обязательно к заполнению!",
          maxLength: "Комментарий не должен превышать 200 символов",
        },
        maxLength: 200,
      }
    }, form_data_loader.query
  );*/

});
