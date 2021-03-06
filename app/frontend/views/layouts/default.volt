<main class="pt-50px">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 order-lg-1">
        <div class="raff-sticky-ad">
          <div class="invisible h2 mb-5 d-none d-lg-block">AD</div>
          <div class="d-flex">
            {{ ads }}
          </div>
        </div>
        <div></div>
      </div>
      <div class="col-12 col-lg-9">
        {{ content() }}    
      </div>
    </div>
  </div>
</main>

<div class="bg-2">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-9 col-lg-7">
        <div class="bg-primary welcome text-white">
          <form method="post" action="/" autocomplete="off" class="form">
            <div id="register"></div>
            <div class="p-4 p-md-7">
              <h3 class="display-4 mb-5">Mehr Gewinnspiele? <br>Jetzt kostenlos anmelden!</h3>
              <div class="form-group">
                <label for="username">Benutzername</label>
                {{ regform.render('username', ['class': 'form-control form-control-lg']) }}
              </div>
              <div class="form-group">
                <label for="password">Passwort</label>
                {{ regform.render('password', ['class': 'form-control form-control-lg']) }}
              </div>
              <div class="form-group">
                <label for="confirmPassword">Passwort wiederholen</label>
                {{ regform.render('confirmPassword', ['class': 'form-control form-control-lg']) }}
              </div>
            </div>
            <div class="inner-bg p-4 p-md-7">
              <div class="form-group form-check mb-7">
                {{ regform.render('terms', ['class': 'form-check-input']) }}
                {{ regform.label('terms', ['class': 'form-check-label']) }}
              </div>
              {{ regform.render('Jetzt kostenlos anmelden!') }}
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>  