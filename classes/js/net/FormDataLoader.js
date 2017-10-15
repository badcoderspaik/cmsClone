APP.FormDataLoader = function (options) {
  var options = options || {},
    url = options.url || "",
    type = options.type || "post",
    form_element = options.form_element,
    formData = new FormData(form_element),
    success = options.success,
    error = options.error,
    beforeSend = options.beforeSend;

  $.ajax({
    url: url,
    type: type,
    processData: false,
    contentType: false,
    data: formData,
    success: success,
    beforeSend: beforeSend
  });
};