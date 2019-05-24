$(function() {
  $('[data-toggle="tooltip"]').tooltip();
  $('#removeTag').on('show.bs.modal', function(event) {
    var button, modal, tagId, tagName;
    button = $(event.relatedTarget);
    tagId = button.data('tagid');
    tagName = button.data('tagname');
    modal = $(this);
    modal.find('#modal-tag-name').text(tagName);
    return modal.find('#tagId').val(tagId);
  });
  $('#price_info').on('change', function(event) {
    if ($(this).is(':checked')) {
      $('#price').attr('rows', 4);
      return console.log('4');
    } else {
      $('#price').attr('rows', 1);
      return console.log('4');
    }
  });
  return $('#companies_id').on('change', function() {
    if ($(this).val() === 'new') {
      return $('#new_game').removeClass('d-none');
    } else {
      return $('#new_game').addClass('d-none');
    }
  });
});

//# sourceMappingURL=admin.js.map
