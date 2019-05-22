<div class="row">
  <div class="col-12 col-md-9 col-lg-7">
    <div class="bg-primary welcome text-white">
      <form method="post" autocomplete="off" class="form">
        <div class="p-7">
          <h3 class="display-4 mb-5">Du möchtest gewinnen?</h3>
          <p>Dann bist du hier auf raffledo.de genau richtig, denn hier findest du täglich neue Gewinnspiele. Die Redaktion achtet darauf, dass seriöse und kostenlose Gewinnspiele aus Deutschland gelistet werden. Neben der Angabe der Preise, die es zu gewinnen gibt, wird auch ein Lösungsvorschlag angezeigt, damit du schnell und einfach beim Gewinnspiel teilnehmen kannst.</p>
        
          <h3 class="display-4 mb-5">Jetzt kostenlos anmelden!</h3>
          <div class="form-group">
            <label for="username">Benutzername</label>
            {{ form.render('username', ['class': 'form-control form-control-lg']) }}
          </div>
          <div class="form-group">
            <label for="password">Passwort</label>
            {{ form.render('password', ['class': 'form-control form-control-lg']) }}
          </div>
          <div class="form-group">
            <label for="confirmPassword">Passwort wiederholen</label>
            {{ form.render('confirmPassword', ['class': 'form-control form-control-lg']) }}
          </div>
        </div>
        <div class="inner-bg p-7">
          <div class="form-group form-check mb-7">
            {{ form.render('terms', ['class': 'form-check-input']) }}
            {{ form.label('terms', ['class': 'form-check-label']) }}
          </div>
          {{ form.render('Jetzt kostenlos anmelden!') }}
        </div>
      </form>
      
      <div class="welcome-footer bg-primary">
        {{ link_to('/gewinnspiele', '› Ohne Registrierung zu den Gewinnspielen') }}
      </div>
    </div>
  </div>
</div>
