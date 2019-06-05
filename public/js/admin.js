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
  }).change();
  $('#url_change .form-control').on('change', function(event) {
    var input;
    input = $(this);
    return $.get("/admin/companies/search", {
      'search': input.val()
    }, function(data) {
      $('#companies_id').val(data.company ? data.company.id : 'new').change();
      if (data.new) {
        $('#c_host').val(data.new.host);
        $('#c_tag').val(data.new.tag);
      }
      return $.get("/admin/games/search", {
        'search': input.val()
      }, function(data) {
        var i, insert_data, insert_item, item, len, ref;
        if (data.exist_game) {
          return input.addClass('is-invalid text-danger');
        } else {
          input.removeClass('is-invalid text-danger');
          if (data.same_game.length > 0) {
            insert_data = $('<div class="list-group list-group-flush"></div>');
            ref = data.same_game;
            for (i = 0, len = ref.length; i < len; i++) {
              item = ref[i];
              insert_item = $('<div class="list-group-item">' + item.title + '<small class="d-block text-truncate">' + item.url + '</small></div>');
              insert_data.append(insert_item);
            }
            $('#existUrl .modal-body').html(insert_data);
            return $('.open-exist').removeClass('d-none');
          } else {
            return $('.open-exist').addClass('d-none');
          }
        }
      }, 'json');
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
