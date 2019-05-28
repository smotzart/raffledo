<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0">New company</h2>  
    <div class="ml-auto mr-2">
      {{ link_to('companies/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div>
      <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
    </div>
  </div>

  {{ content() }}

  <div class="form-group">
    <label for="name">Name</label>
    {{ form.render("name", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="tag">Tag</label>
    {{ form.render("tag", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="host">Host</label>
    {{ form.render("host", ['class': 'form-control']) }}
    <small class="form-text text-muted">Enter new hostname separated by comma</small>
  </div>
  <div class="form-group form-check">
    {{ form.render('footer', ['class': 'form-check-input']) }}
    {{ form.label('footer', ['class': 'form-check-label']) }}
  </div>
  <div class="form-group">
    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
  </div>
</form>