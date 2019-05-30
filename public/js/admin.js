$(function() {
  var tagsname;
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
    return $('#price').attr({
      'placeholder': $(this).is(':checked') ? 'Information' : 'Preis'
    });
  });
  $("[data-tag='yes']").tagsinput({
    tagClass: 'badge badge-info',
    cancelConfirmKeysOnEmpty: false
  });
  $('#companies_id').on('change', function() {
    if ($(this).val() === 'new') {
      return $('#new_game').removeClass('d-none').find('input').removeAttr('disabled');
    } else {
      return $('#new_game').addClass('d-none').find('input').attr('disabled', 'disabled');
    }
  });
  $('#companies_id').change();
  $('#url_change .form-control').on('change', function(event) {
    var input;
    input = $(this);
    return $.get("/admin/companies/search", {
      'search': input.val()
    }, function(data) {
      var i, item, len;
      if (data.length === 1) {
        for (i = 0, len = data.length; i < len; i++) {
          item = data[i];
          $('#companies_id').val(item.id).change();
        }
      }
      return $.get("/admin/games/search", {
        'search': input.val()
      }, function(data) {
        if (data.length > 0) {
          return input.addClass('is-invalid text-danger');
        } else {
          return input.removeClass('is-invalid text-danger');
        }
      }, 'json');
    /*
    if data.length > 0
      insert_data = $('<div class="list-group list-group-flush"></div>')
      for item in data
        insert_item = $('<a href="#" data-company="' + item.id + '" class="list-group-item list-group-item-action">' + item.name + '</a>')
        insert_item.on 'click', (e) ->
          e.preventDefault()
          company_id = $(this).data('company')
          $('#companies_id').val(company_id).change()
          $('#existUrl').modal('hide')
        insert_data.append(insert_item)

      $('#existUrl .modal-body').html(insert_data)
      $('#existUrl').modal('show')
    */
    }, 'json');
  });
  tagsname = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    prefetch: {
      url: '/admin/tags/get',
      cache: false,
      filter: function(tags) {
        return $.map(tags, function(tag) {
          return {
            name: tag.name
          };
        });
      }
    }
  });
  tagsname.initialize();
  return $('#tags_input').tagsinput({
    tagClass: 'badge badge-info',
    cancelConfirmKeysOnEmpty: false,
    trimValue: true,
    typeaheadjs: {
      name: 'tagsname',
      displayKey: 'name',
      valueKey: 'name',
      source: tagsname.ttAdapter()
    }
  });
});

//# sourceMappingURL=admin.js.map
