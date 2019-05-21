<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0">New game</h2>  
    <div class="ml-auto mr-2">
      {{ link_to('games/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div>
      <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
    </div>
  </div>

  {{ content() }}

  <div class="form-group">
    <label for="url">Url</label>
    {{ form.render("url", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="companies_id">Company</label>
    {{ form.render("companies_id", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="title">Title</label>
    {{ form.render("title", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="price">Price</label>
    {{ form.render("price", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <h5>Game type</h5>
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
    {{ form.render("tags_id[]", ['class': 'form-control']) }}
    <small class="form-text text-muted">Hold down the Ctrl (windows) / Command (Mac) button to select multiple tags.</small>
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
    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
  </div>
</form>