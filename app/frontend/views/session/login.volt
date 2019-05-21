<div class="row">
  <div class="col-12 col-md-9 col-lg-7">
    <div class="bg-primary welcome text-white">
      <form method="post" autocomplete="off" class="form">
        <div class="p-7">
          <h3 class="display-4 mb-5">Login</h3>         
          <div class="form-group">
            <label for="email">E-Mail</label>
            {{ form.render('email', ['class': 'form-control form-control-lg']) }}
          </div>
          <div class="form-group">
            <label for="password">Passwort</label>
            {{ form.render('password', ['class': 'form-control form-control-lg']) }}
          </div>
          <div class="form-group form-check">
            {{ form.render('remember', ['class': 'form-check-input']) }}
            {{ form.label('remember', ['class': 'form-check-label']) }}
          </div>
          <div>
            
          {{ form.render('Login') }}    
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
