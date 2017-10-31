APP.Widget.Notification = function (options) {
  var options = options || {},
  that = this;
  this.element = options.element || $("<div>");
  this.content = options.content || "";
  this.element.text(this.content);

  var width = options.width || "",
    marginLeft = options.marginLeft || -(parseInt(width) / 2) + "px",
    padding = options.padding || "10px",
    position = options.position || "fixed",
    left = options.left || "50%",
    top = options.top || "50px",
    marginTop = options.marginTop || "10px",
    display = "none",
    backgroundColor = options.backgroundColor || "blue",
    color = options.color || "white",
    textAlign = options.textAlign || "center",
    borderRadius = options.borderRadius || "5px",
    opacity = options.opacity || 1,
    fontSize = options.fontSize || "",
    boxShadow = options.boxShadow || "",
    duration = options.duration || 2000;

  this.element.css({
    width: width,
    marginLeft: marginLeft,
    padding: padding,
    position: position,
    left: left,
    top: top,
    marginTop: marginTop,
    backgroundColor: backgroundColor,
    color: color,
    textAlign: textAlign,
    borderRadius: borderRadius,
    display: display,
    opacity: opacity,
    fontSize: fontSize,
    boxShadow: boxShadow
  });

  this.show = function (content) {
    var that = this;
    if (content) this.element.text(content);
    this.element.fadeIn('slow');
    return this.element;
  };

  this.hide = function () {
    var that = this;
    setTimeout(function () {
      that.element.fadeOut('slow');
    }, duration);
    return that.element;
  };

  this.content = function (content) {
    if(!content) return content;
    else this.element.text(content);
  };

  this.element.on("mouseover", function () {
    that.hide();
  });

};

APP.Widget.Notification.prototype = APP.Widget;