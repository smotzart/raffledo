$(function() {
  $('[data-toggle="tooltip"]').tooltip();
  $('.toast').toast({
    delay: 50000
  }).toast('show');
  $('.welcome').on('click', 'form', function(event) {
    return $('.welcome-footer').addClass('fade');
  });
  $(document).ready(function() {
    if (window.location.hash) {
      return $.smoothScroll({
        scrollTarget: window.location.hash + "",
        offset: -120,
        afterScroll: function(opt) {
          if (opt.scrollTarget === '#register') {
            return $('.welcome-footer').addClass('fade');
          }
        }
      });
    }
  });
  return $('body').smoothScroll({
    delegateSelector: '[data-scroll="true"]',
    offset: -120,
    speed: 1000,
    afterScroll: function(opt) {
      if (opt.scrollTarget === '#register') {
        return $('.welcome-footer').addClass('fade');
      }
    }
  });
});
