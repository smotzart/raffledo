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
      if (data.company) {
        $('#companies_id').val(data.company.id).change();
      }
      return $.get("/admin/games/search", {
        'search': input.val()
      }, function(data2) {
        var i, insert_data, insert_item, item, len, ref;
        if (data2.length > 0) {
          return input.addClass('is-invalid text-danger');
        } else {
          input.removeClass('is-invalid text-danger');
          if (data.company && data.games.length > 0) {
            insert_data = $('<div class="list-group list-group-flush"></div>');
            ref = data.games;
            for (i = 0, len = ref.length; i < len; i++) {
              item = ref[i];
              insert_item = $('<div class="list-group-item">' + item.title + '<small class="d-block text-truncate">' + item.url + '</small></div>');
              insert_data.append(insert_item);
            }
            $('#existUrl .modal-body').html(insert_data);
            return $('.open-exist').removeClass('d-none');
          }
        }
      
      //$('#existUrl').modal('show')
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
