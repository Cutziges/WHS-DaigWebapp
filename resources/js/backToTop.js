$(function() {

  var $button = $('#topButton');
  var $top = $('#top');
  var startpoint = $top.scrollTop() + $top.height();

  $(window).on('scroll', function() {
    if($(window).scrollTop() > startpoint) {
      $button.show();
    } else {
      $button.hide();
    }
  });
});
