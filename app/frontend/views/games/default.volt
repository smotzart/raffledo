<div class="box-header mb-5">
  <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
</div>
{% for game in games %}
  {{ partial('partials/game-default', ['game': game]) }}
{% else %}
  <div class="box">
    <div class="box-body text-center py-7">    
      <div class="row">
        <div class="col-12 col-md-9 col-lg-8 mx-auto">
          <p class="mb-0">Keine Gewinnspiele mehr <br class="d-none d-lg-block">vorhanden - schaue morgen wieder vorbei</p>
        </div>
      </div>
    </div>
  </div>
{% endfor %}
