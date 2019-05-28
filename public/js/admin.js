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
  $('#url_change .form-control').on('change', function(event) {
    return $.get("/admin/companies/search", {
      'search': $(this).val()
    }, function(data) {
      var i, insert_data, insert_item, item, len;
      if (data.length > 0) {
        insert_data = $('<div class="list-group list-group-flush"></div>');
        for (i = 0, len = data.length; i < len; i++) {
          item = data[i];
          insert_item = $('<a href="#" data-company="' + item.id + '" class="list-group-item list-group-item-action">' + item.name + '</a>');
          insert_item.on('click', function(e) {
            var company_id;
            e.preventDefault();
            company_id = $(this).data('company');
            $('#companies_id').val(company_id).change();
            return $('#existUrl').modal('hide');
          });
          insert_data.append(insert_item);
        }
        $('#existUrl .modal-body').html(insert_data);
        return $('#existUrl').modal('show');
      }
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
