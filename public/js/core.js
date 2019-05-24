$(function() {
  $('[data-toggle="tooltip"]').tooltip();
  return $('#reportGameModal').on('show.bs.modal', function(event) {
    var button, gameId, modal;
    button = $(event.relatedTarget);
    gameId = button.data('gameid');
    modal = $(this);
    return modal.find('#reportGameId').val(gameId);
  });
});

//# sourceMappingURL=core.js.map
