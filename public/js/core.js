$(function() {
  $('[data-toggle="tooltip"]').tooltip();
  $('.toast').toast('show');
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

/*
$('#hideTagsModal')
  .on 'show.bs.modal', (event) ->
    button = $(event.relatedTarget) 
    gameId = button.data('gameid')
    modal  = $(this)

    $.get "/index/tags", {'games_id': gameId}, (data) ->
if data.length > 0
insert_data = ''
for item in data
  insert_data += '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" name="tags_id[]" value="' + item.id + '" id="customCheck' + item.id + '"><label class="custom-control-label" for="customCheck' + item.id + '">' + item.name + '</label></div> '
$('#modal_tags_list').html(insert_data)      
else
modal.find('[type="submit"]').hide()
    , 'json'

  .on 'hide.bs.modal', (event) ->
    modal  = $(this)
    modal.find('[type="submit"]').show()
    $('#modal_tags_list').html("Game don't have related tags") 

$('.view-game').on 'click', (event) ->    
  event.preventDefault()
  link  = $(this).attr('href')
  id    = $(this).data('game')
  el    = document.getElementById("view-game-" + id)
  if el != null
    range = document.createRange()
    range.selectNodeContents(el)
    sel   = window.getSelection()
    sel.removeAllRanges()
    sel.addRange(range)
    document.execCommand('copy')

  $('#box-' + id).find('.game-hide-control').fadeOut 'slow', () ->
    window.open link

$('#regular-games .box-hide-form').each (i,e)->
  $(e).ajaxForm
    success: () -> 
$this     = $(e)
box_body  = $('#regular-games-body')
box_head  = $('#regular-games .box-header')
box       = $this.closest('.box')
order     = box.data('order')
child     = box_body.children().length
favs      = $('#favs-games-body').children().length
box.fadeOut 'fast', () ->
console.log child, box_head
if child == 1 && favs != 0
  box_head.removeClass('d-block').addClass('d-none')
if child == 1 && favs == 0
  $('#regular-games-empty').removeClass('d-none').addClass('d-block')
else 
  $('#regular-games-empty').removeClass('d-block').addClass('d-none')
.remove()

$('#favs-games .box-hide-form').each (i,e)->
  $(e).ajaxForm
    success: () -> 
$this     = $(e)
box_body  = $('#favs-games-body')
box_head  = $('#favs-games .box-header')
box       = $this.closest('.box')
order     = box.data('order')
child     = box_body.children().length

box.fadeOut 'fast', () ->
if child == 1 || child == 0
  box_head.removeClass('d-block').addClass('d-none')
.remove()

$('.box-save-form').each (i,e) ->  
  $(e).ajaxForm
    success: () -> 
$this       = $(e)
box         = $this.closest('.box')
box_parent  = box.closest('.box-parent')
box_header  = box_parent.siblings('.box-header')
box_order   = box.data('order')
boxes_count = box.siblings().length
form        = $this.closest('.box-save-form')     

if box_parent.hasClass('regular')
another_boxes   = $('#favs-games-body').children().length
another_header  = $('#favs-games').find('.box-header')
another_parent  = $('#favs-games-body')
else
another_boxes   = $('#regular-games-body').children().length
another_header  = $('#regular-games').find('.box-header')
another_parent  = $('#regular-games-body')

cloneItem = box.clone(true)

box.fadeOut 'fast', () ->
if boxes_count == 0
  box_header.removeClass('d-block').addClass('d-none')
if another_boxes == 0
  another_header.removeClass('d-none').addClass('d-block')

if box_order == 0
  another_parent.prepend(cloneItem)
else
  another_parent.append(cloneItem)
.remove()
*/
