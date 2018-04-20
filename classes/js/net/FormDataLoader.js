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