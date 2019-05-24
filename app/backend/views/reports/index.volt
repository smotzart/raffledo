<div class="d-flex align-items-center pb-2 border-bottom mb-4">
  <h2 class="m-0">Reports</h2>  
</div>
{{ flashSession.output() }}
<div class="container-fluid mb-5">
  <div class="row py-3 bg-light text-muted">
    <div class="col-4 font-weight-bold">User</div>
    <div class="col-8 font-weight-bold">Game</div>    
  </div>
  {% for report in reports %}
    <div class="row py-2 border-top align-items-center">
      <div class="col-4">{{ report.user.username }}</div>
      <div class="col-6">
        <div class="text-truncate">{{ report.game.title }}</div>
      </div>  
      <div class="col-2 d-flex align-items-center">
        {{ link_to('reports/view/' ~ report.id, '<i class="fa fa-eye"></i>', 'class': 'btn btn-sm btn-info ml-auto') }}
        {{ link_to('reports/delete/' ~ report.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-sm btn-danger ml-3') }}
      </div>
    </div>
  {% else %}
    <div class="py-2"><i>Empty list</i></div>
  {% endfor %}
</div>