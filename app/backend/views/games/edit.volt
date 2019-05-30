<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0">{{ game.title }}</small></h2>  
    <div class="ml-auto mr-2">
      {{ link_to('games/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div class="mr-2">
      {{ link_to('games/delete/' ~ game.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-outline-danger') }}
    </div>
    <div>
      <button type="submit" class="btn btn-outline-success"><i class="fa fa-save"></i></button>
      <button type="submit" name="again" class="btn btn-success ml-2"><i class="fa fa-save mr-2"></i>Save and new</button>
    </div>
  </div>

  {{ content() }}

  <div class="form-group">
    <label for="url">URL</label>
    {{ form.render("url", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="companies_id">Anbieter</label>
    {{ form.render("companies_id", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="title">Titel</label>
    {{ form.render("title", ['class': 'form-control']) }}
  </div>
  
  <div class="form-group">
    <label for="price">Preis</label>
    <div class="form-group form-check">
      {{ form.render('price_info', ['class': 'form-check-input']) }}
      {{ form.label('price_info', ['class': 'form-check-label']) }}
    </div>
    {{ str_replace('<br />', '&#13;&#10;', form.render("price", ['class': 'form-control']) | nl2br) }}
  </div>
  <div class="form-group">
    <h5>Gewinnspiel Typ</h5>
    <div class="form-check">
      {{ form.render('type_register', ['class': 'form-check-input']) }}
      {{ form.label('type_register', ['class': 'form-check-label']) }}
    </div>
    <div class="form-check">
      {{ form.render('type_sms', ['class': 'form-check-input']) }}
      {{ form.label('type_sms', ['class': 'form-check-label']) }}
    </div>
    <div class="form-check">
      {{ form.render('type_buy', ['class': 'form-check-input']) }}
      {{ form.label('type_buy', ['class': 'form-check-label']) }}
    </div>
    <div class="form-check">
      {{ form.render('type_internet', ['class': 'form-check-input']) }}
      {{ form.label('type_internet', ['class': 'form-check-label']) }}
    </div>
    <div class="form-check">
      {{ form.render('type_submission', ['class': 'form-check-input']) }}
      {{ form.label('type_submission', ['class': 'form-check-label']) }}
    </div>  
  </div>
  <div class="form-group">
    <label for="tags_id">Tags</label>
    {{ form.render("tags_id[]", ['class': 'form-control', 'id': 'tags_input']) }}
    <small class="form-text text-muted">Enter new tag separated by comma</small>
  </div>
  <div class="form-group">
    <label for="suggested_solution">Lösungsvorschlag</label>
    {{ form.render("suggested_solution", ['class': 'form-control']) }}
  </div>
  <div class="row">
    <div class="col-12 col-md-6">
      <div class="form-group">
        <label for="deadline_date">Einsendeschluss</label>
        <div class="row">
          <div class="col-8">
            {{ form.render("deadline_date", ['class': 'form-control']) }}            
          </div>
          <div class="col-4">
            {{ form.render("deadline_time", ['class': 'form-control']) }}            
          </div>
        </div>  
      </div>      
    </div>
    <div class="col-12 col-md-6">
      <div class="form-group">
        <label for="enter_date">Eintrag für</label>
        <div class="row">
          <div class="col-8">
            {{ form.render("enter_date", ['class': 'form-control']) }}            
          </div>
          <div class="col-4">
            {{ form.render("enter_time", ['class': 'form-control']) }}            
          </div>
        </div>
      </div>      
    </div>
  </div>

  <div class="form-group">
    {{ link_to('games/delete/' ~ game.id, '<i class="fa fa-trash-o mr-2"></i>Delete', 'class': 'btn btn-outline-danger') }}
    <button type="submit" class="btn btn-outline-success"><i class="fa fa-save mr-2"></i>Save</button>
    <button type="submit" name="again" class="btn btn-success ml-2"><i class="fa fa-save mr-2"></i>Save and new</button>
  </div>
</form>