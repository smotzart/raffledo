<div class="box-header mb-5">
  <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
</div>
{% for game in games %}
  {{ partial('partials/game-default', ['game': game]) }}
{% endfor %}
