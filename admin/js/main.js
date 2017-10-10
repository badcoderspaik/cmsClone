$(function () {
  var add_content_form = $("#add_content_form"),
    submit_btn = $("input[type='submit']", add_content_form),
    cover = $("input[name='cover']"),
    form_notification = new APP.Widget.Notification.CheckForm({
      width: "400px",
      color: "yellow",
      fontSize: "larger",
      boxShadow: "-5px 5px 10px gray"
    });
  form_notification.append();

  add_content_form.on("submit", function (event) {
    event.preventDefault();
    var formData = new FormData(this),
      $that = $(this);
    $.ajax({
      url: "../admin/modules/add_content_form.php",
      type: "post",
      processData: false,
      contentType: false,
      data: formData,

      success: function (content) {
        form_notification.show(content);
      },

      beforeSend: function () {
        form_notification.show("Обработка данных...");
      }

    })
  });

});