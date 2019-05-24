<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0">Report {{ report.id }}</h2>  
    <div class="ml-auto mr-2">
      {{ link_to('reports/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div class="mr-2">
      {{ link_to('reports/delete/' ~ report.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-outline-danger') }}
    </div>
  </div>

  {{ content() }}

  <div class="form-group">
    <h5>User</h5>
    <p>{{ report.user.username }}</p>
  </div>
  <div class="form-group">
    <h5>Game</h5>
    <p>{{ report.game.title }}</p>
  </div>
  <div class="form-group">
    <h5>Text</h5>
    <p>{{ report.report }}</p>
  </div>
  <div class="form-group">
    {{ link_to('reports/delete/' ~ report.id, '<i class="fa fa-trash-o mr-2"></i>Delete', 'class': 'btn btn-outline-danger') }}
    {{ link_to('reports/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
  </div>
</form>