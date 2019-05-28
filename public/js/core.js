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
      var insert_data, item, j, len;
      if (data.length > 0) {
        insert_data = '';
        for (j = 0, len = data.length; j < len; j++) {
          item = data[j];
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
  $('.view-game').on('click', function(event) {
    var el, id, link, range, sel;
    event.preventDefault();
    link = $(this).attr('href');
    id = $(this).data('game');
    el = document.getElementById("view-game-" + id);
    console.log("1");
    if (el !== null) {
      console.log("2");
      range = document.createRange();
      range.selectNodeContents(el);
      sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(range);
      document.execCommand('copy');
      return $('#box-' + id).find('.game-hide-control').fadeOut('slow', function() {
        return window.open(link);
      });
    }
  });
  $('#regular-games .box-hide-form').each(function(i, e) {
    return $(e).ajaxForm({
      success: function() {
        var $this, box, box_body, box_head, child, favs, order;
        $this = $(e);
        box_body = $('#regular-games-body');
        box_head = $('#regular-games .box-header');
        box = $this.closest('.box');
        order = box.data('order');
        child = box_body.children().length;
        favs = $('#favs-games-body').children().length;
        return box.fadeOut('fast', function() {
          console.log(child, box_head);
          if (child === 1 && favs !== 0) {
            box_head.removeClass('d-block').addClass('d-none');
          }
          if (child === 1 && favs === 0) {
            return $('#regular-games-empty').removeClass('d-none').addClass('d-block');
          } else {
            return $('#regular-games-empty').removeClass('d-block').addClass('d-none');
          }
        }).remove();
      }
    });
  });
  $('#favs-games .box-hide-form').each(function(i, e) {
    return $(e).ajaxForm({
      success: function() {
        var $this, box, box_body, box_head, child, order;
        $this = $(e);
        box_body = $('#favs-games-body');
        box_head = $('#favs-games .box-header');
        box = $this.closest('.box');
        order = box.data('order');
        child = box_body.children().length;
        return box.fadeOut('fast', function() {
          if (child === 1 || child === 0) {
            return box_head.removeClass('d-block').addClass('d-none');
          }
        }).remove();
      }
    });
  });
  return $('.box-save-form').each(function(i, e) {
    return $(e).ajaxForm({
      success: function() {
        var $this, another_boxes, another_header, another_parent, box, box_header, box_order, box_parent, boxes_count, cloneItem, form;
        $this = $(e);
        box = $this.closest('.box');
        box_parent = box.closest('.box-parent');
        box_header = box_parent.siblings('.box-header');
        box_order = box.data('order');
        boxes_count = box.siblings().length;
        form = $this.closest('.box-save-form');
        if (box_parent.hasClass('regular')) {
          another_boxes = $('#favs-games-body').children().length;
          another_header = $('#favs-games').find('.box-header');
          another_parent = $('#favs-games-body');
        } else {
          another_boxes = $('#regular-games-body').children().length;
          another_header = $('#regular-games').find('.box-header');
          another_parent = $('#regular-games-body');
        }
        cloneItem = box.clone(true);
        return box.fadeOut('fast', function() {
          if (boxes_count === 0) {
            box_header.removeClass('d-block').addClass('d-none');
          }
          if (another_boxes === 0) {
            another_header.removeClass('d-none').addClass('d-block');
          }
          if (box_order === 0) {
            return another_parent.prepend(cloneItem);
          } else {
            return another_parent.append(cloneItem);
          }
        }).remove();
      }
    });
  });
});

//# sourceMappingURL=core.js.map
