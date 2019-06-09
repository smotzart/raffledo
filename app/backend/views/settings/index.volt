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
    <div class="col-12">
      <hr>
    </div>
    <div class="col-12">
      <div class="row">
        <div class="col-12 col-md-6">
          <h5 class="text-theme">Home page</h5>
          <div class="form-group">
            <label for="title">Title</label>
            {{ form.render("title", ['class': 'form-control']) }}
          </div>  
          <div class="form-group">
            <label for="description">Description</label>
            {{ form.render("description", ['class': 'form-control']) | nl2br }}
          </div>          
        </div>
        <div class="col-12 col-md-6">
          <h5 class="text-theme">List page</h5>
          <div class="form-group">
            <label for="title_game">Title</label>
            {{ form.render("title_game", ['class': 'form-control']) }}
          </div>  
          <div class="form-group">
            <label for="description_game">Description</label>
            {{ form.render("description_game", ['class': 'form-control']) | nl2br }}
          </div>  
        </div>
        <div class="col-12 col-md-6">
          <h5 class="text-theme">Tag page</h5>
          <div class="form-group">
            <label for="title_tag">Title</label>
            {{ form.render("title_tag", ['class': 'form-control']) }}
          </div>  
          <div class="form-group">
            <label for="description_tag">Description</label>
            {{ form.render("description_tag", ['class': 'form-control']) | nl2br }}
            <small class="form-text text-muted">Use <b>%tag%</b> as placeholder for tag name</small>
          </div>  
        </div>
        <div class="col-12 col-md-6">
          <h5 class="text-theme">Company page</h5>
          <div class="form-group">
            <label for="title_company">Title</label>
            {{ form.render("title_company", ['class': 'form-control']) }}
          </div>  
          <div class="form-group">
            <label for="description_company">Description</label>
            {{ form.render("description_company", ['class': 'form-control']) | nl2br }}
            <small class="form-text text-muted">Use <b>%company%</b> as placeholder for company name</small>
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