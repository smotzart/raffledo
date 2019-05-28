<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0">New game</h2>  
    <div class="ml-auto mr-2">
      {{ link_to('games/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div>
      <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
      <button type="submit" name="again" class="btn btn-outline-success ml-2"><i class="fa fa-save mr-2"></i>Save and new</button>
    </div>
  </div>

  {{ content() }}

  <div class="form-group" id="url_change">
    <label for="url">URL</label>
    {{ form.render("url", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="companies_id">Anbieter</label>
    {{ form.render("companies_id", ['class': 'form-control']) }}
    <small class="form-text text-muted">Choose from existing or create new</small>
  </div>
  <div class="row bg-light py-4 mb-3" id="new_game">
    <div class="col-12">
      <h5>New company</h5>
    </div>
    <div class="col-6">
      <div class="form-group">
        <label for="c_name">Name</label>
        {{ form.render("c_name", ['class': 'form-control']) }}
      </div>
    </div>
    <div class="col-6">
      <div class="form-group">
        <label for="c_tag">Tag</label>
        {{ form.render("c_tag", ['class': 'form-control']) }}
      </div>
    </div>
    <div class="col-12">
      <div class="form-group">
        <label for="c_host">Host</label>
        {{ form.render("c_host", ['class': 'form-control']) }}
      </div>
    </div>
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
    {{ form.render("price", ['class': 'form-control']) | nl2br }}
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
    <button type="submit" name="again" class="btn btn-outline-success ml-2"><i class="fa fa-save mr-2"></i>Save and new</button>
  </div>
</form>

<div class="modal fade" id="existUrl" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content rounded-0">   
      <div class="modal-header">
        <h5 class="modal-title">Existing companies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>  
      <div class="modal-body p-0"></div>
      <div class="modal-footer">
        <small class="text-muted mr-auto">Choose from existing companies or close <br> to be able to create a new one.</small>
        <button type="button" class="btn btn-sm btn-outline-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>