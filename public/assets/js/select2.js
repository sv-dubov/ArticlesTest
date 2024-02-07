// npm package: select2
// github link: https://github.com/select2/select2

$(function() {
  'use strict'

  if ($(".js-example-basic-single").length) {
    $(".js-example-basic-single").select2();
  }

  if ($(".js-example-basic-multiple").length) {
    $(".js-example-basic-multiple").select2();
  }

  $(window).resize(() => {
    if ($(".js-example-basic-single").length) {
      $(".js-example-basic-single").select2();
    }
  
    if ($(".js-example-basic-multiple").length) {
      $(".js-example-basic-multiple").select2();
    }
  });

  $(document).on('change', '.js-example-basic-single', function (e) {
    e.target.dispatchEvent(new Event('change'));
  });

  $(document).on('change', '.js-example-basic-multiple', function (e) {
    e.target.dispatchEvent(new Event('change'));
  });

});