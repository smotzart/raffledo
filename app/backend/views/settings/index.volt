<form method="post" autocomplete="off">
  <div class="pb-2 border-bottom mb-4">
    <h2 class="m-0">Settings</h2>  
  </div>

  {{ content() }}
  
  <div class="row align-items-end">
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="tag">Entry amount</label>
            {{ form.render("entry_amount", ['class': 'form-control']) }}
          </div>      
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="name">Einsendeschluss</label>
            {{ form.render("deadline_time", ['class': 'form-control']) }}     
          </div>      
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="description">Eintrag für</label>
            {{ form.render("enter_time", ['class': 'form-control']) }}     
          </div>      
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="google_tag">Google tag</label>
            {{ form.render("google_tag", ['class': 'form-control']) | nl2br }}
          </div>      
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="ads_regular">Banner for not registered</label>
            {{ form.render("ads_regular", ['class': 'form-control']) | nl2br }}     
          </div>      
        </div>
        <div class="col-12 col-md-4">
          <div class="form-group">
            <label for="ads_register">Banner for registered</label>
            {{ form.render("ads_register", ['class': 'form-control']) | nl2br }}     
          </div>      
        </div>
      </div>
    </div>
    <div class="col-12 col-md-2">
      <div class="form-group">
        <button type="submit" class="btn btn-block btn-success"><i class="fa fa-save mr-2"></i>Save</button>
      </div>      
    </div>    
  </div>
</form>