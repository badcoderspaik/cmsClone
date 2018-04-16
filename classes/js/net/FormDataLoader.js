APP.FormDataLoader = function (options) {
  var options = options || {},
    url = options.url || "",
    type = options.type || "post",
    form_element = options.form_element,
    success = options.success,
    error = options.error ||function () {
        alert("Ошибка сети");
      },
    beforeSend = options.beforeSend,
    author = form_element.find("input[name='author']"),
    textarea = form_element.find("textarea[name='comment']"),
    hidden = form_element.find("input[name='comment_id']"),
    formData = new FormData();
  FormData.set(author[0]);
  FormData.set(textarea[0]);
  FormData.set(hidden[0]);

  form_element.on("submit", function (event) {
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
  });

};

APP.FormDataLoader.prototype = APP.Net;