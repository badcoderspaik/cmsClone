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

});