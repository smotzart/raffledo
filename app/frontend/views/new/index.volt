<h1>Gewinnspielformular</h1>
<div class="row">
  <div class="col-12 col-md-10 col-lg-8">
    <h5 class="text-theme">Gewinnspiel kostenlos eintragen</h5>
    <p class="lead">Sie möchten ein Gewinnspiel melden/eintragen? Genau das können Sie hier nun machen. URL und eine kurze Beschreibung worum es geht und schon wird Ihre Meldung redaktionell geprüft und gegebenfalls freigeschalten.</p>
  </div>
  <div class="col-12 col-lg-6">
    {{ content() }}
    <form method="post" autocomplete="off">   
      <div class="form-group">
        {{ form.render("company", ['class': 'form-control']) }}
      </div>
      <div class="form-group">
        {{ form.render("url", ['class': 'form-control']) }}
      </div>
      <div class="form-group">
        <label for="text1">Beschreibung/Anmerkung:</label>
        {{ form.render("text1", ['class': 'form-control']) }}
      </div>
      <div class="form-group">
        <label for="text2">Kontaktperson für Rückfragen:</label>
        {{ form.render("text2", ['class': 'form-control']) }}
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-outline-theme">Gewinnspiel melden</button>
      </div>
    </form>
  </div>
</div>