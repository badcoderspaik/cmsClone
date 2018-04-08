APP.Widget = {

  append: function ($context) {
    $context = $context || $('body');
    $context.append(this.element);
  }
};
