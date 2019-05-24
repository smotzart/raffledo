<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0">{{ newGame.company }}</h2>  
    <div class="ml-auto mr-2">
      {{ link_to('new/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div class="mr-2">
      {{ link_to('new/delete/' ~ newGame.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-outline-danger') }}
    </div>
  </div>

  {{ content() }}

  <div class="form-group">
    <h5>Firma od. Anbieter</h5>
    <p>{{ newGame.company }}</p>
  </div>
  <div class="form-group">
    <h5>URL zum Gewinnspiel</h5>
    <p><a href="{{ url(newGame.url) }}" class="mr-2 float-left" target="_blank"><i class="fa fa-external-link-square"></i></a>{{ newGame.url }}</p>
  </div>
  <div class="form-group">
    <h5>Beschreibung/Anmerkung:</h5>
    <p>{{ newGame.text1 }}</p>
  </div>
  <div class="form-group">
    <h5>Kontaktperson für Rückfragen:</h5>
    <p>{{ newGame.text2 }}</p>
  </div>


  <div class="form-group">
    {{ link_to('new/delete/' ~ newGame.id, '<i class="fa fa-trash-o mr-2"></i>Delete', 'class': 'btn btn-outline-danger') }}
    {{ link_to('new/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
  </div>
</form>