$(function() {
  $('[data-toggle="tooltip"]').tooltip();
  $('.welcome').on('click', 'form', function(event) {
    return $('.welcome-footer').addClass('fade');
  });
  $('#reportGameModal').on('show.bs.modal', function(event) {
    var button, gameId, modal;
    button = $(event.relatedTarget);
    gameId = button.data('gameid');
    modal = $(this);
    return modal.find('#reportGameId').val(gameId);
  });
  $('#hideTagsModal').on('show.bs.modal', function(event) {
    var button, gameId, modal;
    button = $(event.relatedTarget);
    gameId = button.data('gameid');
    modal = $(this);
    return $.get("/index/tags", {
      'games_id': gameId
    }, function(data) {
      var i, insert_data, item, len;
      if (data.length > 0) {
        insert_data = '';
        for (i = 0, len = data.length; i < len; i++) {
          item = data[i];
          insert_data += '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="tags_id[]" value="' + item.id + '" id="customCheck' + item.id + '"><label class="custom-control-label" for="customCheck' + item.id + '">' + item.name + '</label></div> ';
        }
        return $('#modal_tags_list').html(insert_data);
      } else {
        return modal.find('[type="submit"]').hide();
      }
    }, 'json');
  }).on('hide.bs.modal', function(event) {
    var modal;
    modal = $(this);
    modal.find('[type="submit"]').show();
    return $('#modal_tags_list').html("Game don't have related tags");
  });
  return $('.view-game').on('click', function(event) {
    var el, id, range, sel;
    id = $(this).data('game');
    el = document.getElementById("view-game-" + id);
    if (el !== null) {
      range = document.createRange();
      range.selectNodeContents(el);
      sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(range);
      return document.execCommand('copy');
    }
  });
});

//# sourceMappingURL=core.js.map
