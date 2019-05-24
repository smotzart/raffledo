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
  $('#companies_id').on('change', function() {
    if ($(this).val() === 'new') {
      return $('#new_game').removeClass('d-none');
    } else {
      return $('#new_game').addClass('d-none');
    }
  });
  return $('#url_change .form-control').on('change', function(event) {
    return $.get("/admin/games/search", {
      'search': $(this).val()
    }, function(data) {
      var i, insert_data, item, len;
      console.log(data.length);
      if (data.length > 0) {
        insert_data = '<ul class="list-group list-group-flush">';
        for (i = 0, len = data.length; i < len; i++) {
          item = data[i];
          insert_data += '<li class="list-group-item"><h5>' + item.title + '</h5><small>' + item.url + '</small></li>';
        }
        insert_data += '</ul>';
        $('#existUrl .modal-body').html(insert_data);
        return $('#existUrl').modal('show');
      }
    }, 'json');
  });
});

//# sourceMappingURL=admin.js.map
