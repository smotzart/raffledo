<main class="pt-50px">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 order-lg-1">
        <div class="raff-sticky-ad">
          <h2 class="invisible mb-5">AD</h2>
          <div class="d-flex">
            <a href class="d-block mx-auto mb-g"><img src="img/banner.png" alt="MySEO" class="img-fluid"></a>
          </div>
        </div>
      </div>
      <div class="col-12 col-lg-9" ng-app="app" ng-controller="AppCtrl" ng-init="initValue = {% if tag_data is defined %}'{{ tag_data['tag_value'] }}'{% else %}false{% endif %}; initName = {% if tag_data is defined %}'{{ tag_data['tag_name'] }}'{% else %}false{% endif %}">
        {{ content() }}    
      </div>
    </div>
  </div>
</main>

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
