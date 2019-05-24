<div class="mb-5">
  <h2 class="text-capitalize m-0">{% if search_name %}{{ search_name }}{% else %}Aktuelle Gewinnspiele{% endif %}</h2>
  {% if search_description is defined %}
    <p class="lead">{{ search_description }}</p>
  {% endif %}
</div>

<div class="row mb-65px">
  <div class="col-12 col-lg-3 order-lg-1">
    <div class="d-flex">
      <a href class="d-block mx-auto mb-g"><img src="img/banner.png" alt="MySEO" class="img-fluid"></a>
    </div>
  </div>
  <div class="col-12 col-lg-9">
    {{ content() }}
  </div>
</div>


<div class="modal fade" id="reportGameModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-body p-7">
        <h3 class="text-theme">Gewinnspiel melden</h3>
        <p class="lead">Etwas stimmt mit diesem Spiel nicht, dann teilen Sie uns mit was.</p>
        <form action="games/report" method="post" accept-charset="utf-8">
          <input type="hidden" name="games_id" id="reportGameId" value="" />
          <div class="form-group">
            <label for="report">Ihre Nachricht</label>
            {{ report.render("report", ['class': 'form-control']) }}
          </div>         
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbruch</button>
          <button type="submit" class="btn btn-theme ml-3">Jetzt absenden</button>
        </form>
        
      </div>
    </div>
  </div>
</div>


