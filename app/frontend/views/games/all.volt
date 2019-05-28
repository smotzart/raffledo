{% set order = 0 %}

<div id="regular-games" {% if limited_view is defined %}class="limited-view"{% endif %}>
  {% if limited_view is defined and search_name is defined %}
    <div class="box-header mb-5">
      <h2 class="m-0"><span class="text-capitalize">{{ search_name }}</span> {% if search_description is defined %}<small class="text-muted">{{ search_description }}</small>{% endif %}</h2>
    </div>
  {% else %}
    <div class="box-header mb-5 d-{% if (games | length) == 0 and (favs is defined and (favs | length) > 0)%}none{% else %}block{% endif %}">
      <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
    </div>
  {% endif %}
  <div id="regular-games-body" class="box-parent regular">
    {% for game in games %}

      {% if register_view is defined %}
        {{ partial('partials/game', ['lindex': order, 'game': game.g, 'logged_in': logged_in, 'is_view': game.is_view]) }}
      {% else %}
        {{ partial('partials/game', ['lindex': order, 'game': game, 'logged_in': logged_in]) }}
      {% endif %}
      {% set order = order + 1 %}

    {% endfor %}
  </div>
  <div id="regular-games-empty" class="box d-{% if (favs is not defined or (favs | length) == 0) and ((games | length) == 0 or games is not defined) %}block{% else %}none{% endif %}" id="box-empty">
    <div class="box-body text-center py-7">    
      <div class="row">
        <div class="col-12 col-md-9 col-lg-8 mx-auto">
          <div class="box-label mb-5">Filter aktiv</div>
          <p class="mb-7">Du nutzt einen Filter, dadurch werden nicht alle <br class="d-none d-lg-block">Gewinnspiele angezeigt.</p>
          <a href="/gewinnspiele-zeige-mir-alle-gewinnspiele-die-ich-noch-nicht-ausgeblendet-habe" class="btn btn-block btn-theme">Weitere Gewinnspiele anzeigen</a>
        </div>
      </div>
    </div>
  </div>
</div>