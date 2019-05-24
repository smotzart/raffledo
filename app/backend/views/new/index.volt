<div class="d-flex align-items-center pb-2 border-bottom mb-4">
  <h2 class="m-0">New games</h2>  
</div>
{{ flashSession.output() }}
<div class="container-fluid mb-5">
  <div class="row py-3 bg-light text-muted">
    <div class="col-4 font-weight-bold">Anbieter</div>
    <div class="col-8 font-weight-bold">URL</div>    
  </div>
  {% for game in newGames %}
    <div class="row py-2 border-top align-items-center">
      <div class="col-4">{{ game.company }}</div>
      <div class="col-6">
        <a href="{{ url(game.url) }}" class="mr-2 float-left" target="_blank"><i class="fa fa-external-link-square"></i></a>
        <div class="text-truncate">{{ game.url }}</div>
      </div>  
      <div class="col-2 d-flex align-items-center">
        {{ link_to('new/view/' ~ game.id, '<i class="fa fa-eye"></i>', 'class': 'btn btn-sm btn-info ml-auto') }}
        {{ link_to('new/delete/' ~ game.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-sm btn-danger ml-3') }}
      </div>
    </div>
  {% else %}
    <div class="py-2"><i>Empty list</i></div>
  {% endfor %}
</div>