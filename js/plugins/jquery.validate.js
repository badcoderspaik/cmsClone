(function ($) {
  $.fn.validate = function (options, success) {

    var form = this;

    this.on("submit", function (event) {
      var error = false;
      event.preventDefault();
      event.stopPropagation();
      $.each(options, function (name, value) {

        var current = form.find("[name =" + name + "]");
        current.siblings().remove();

        if (value.required != undefined && value.required == true) {
          if ($.trim(current.val()).length == 0) {
            //event.preventDefault();
            error = true;
            if (!(current.siblings().is($(".empty-message")))) {
              current.css("outline", "1px solid red");
              current.after($("<div class='empty-message' style='color: red; font-size: smaller; margin-top: 5px;'>" + value.messages.empty + "</div>"));
            }
          } else {
            current.css("outline", "");
            $(".empty-message", current).remove();
          }
        }

        if (value.minLength != undefined) {
          if ($.trim(current.val()).length < value.minLength) {
            //event.preventDefault();
            error = true;
            if (!(current.siblings().is($(".min-message")))) {
              current.css("outline", "1px solid red");
              current.after($("<div class='min-message' style='color: red; font-size: smaller; margin-top: 5px;'>" + value.messages.minLength + "</div>"));
            }
          } else {
            current.css("outline", "");
            $(".min-message", current).remove();
          }
        }

        if ((value.maxLength != undefined) && ($.trim(current.val()).length != 0)) {
          if ($.trim(current.val()).length > value.maxLength) {
            //event.preventDefault();
            error = true;
            if (!(current.siblings().is($(".max-message")))) {
              current.css("outline", "1px solid red");
              current.after($("<div class='max-message' style='color: red; font-size: smaller; margin-top: 5px;'>" + value.messages.maxLength + "</div>"));
            }
          } else {
            current.css("outline", "");
            $(".max-message", current).remove();
            console.log(error);
          }
        }

        if (value.expression != undefined) {
          if (!value.expression.test($.trim(current.val()))) {
            //event.preventDefault();
            error = true;
            if (!(current.siblings().is($("expression-message")))) {
              current.css("outline", "1px solid red");
              current.after($("<div class='expression-message' style='color: red; font-size: smaller; margin-top: 5px;'>" + value.messages.expression + "</div>"));
            }
          } else {
            current.css("outline", "");
            $(".expression-message", current).remove();
          }
        }
      });
      console.log(error);
      if (success) {
        if (!error) {
          success();
        }
      }

    });
  };
}(jQuery));
