
{% set title = 0 %}



{% for game in page.items %}
  
  {% if loop.first %}
    {% if limited_view is defined and search_name is defined %}
      <div class="mb-5">
        <h2 class="m-0"><span class="text-capitalize">{{ search_name }}</span> {% if search_description is defined %}<small class="text-muted">{{ search_description }}</small>{% endif %}</h2>
      </div>
    {% elseif register_view is defined and game.save_id %}
      {% set title = 1 %}
      <div class="mb-5">
        <h2 class="text-capitalize m-0">Favoriten</h2>
      </div>
    {% else %}
      <div class="mb-5">
        <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
      </div>
    {% endif %}
  {% endif %}

  {% if loop.index > 1 and register_view is defined and !game.save_id and title == 1 %}
    {% set title = 0 %}
    <div class="mb-5">
      <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
    </div>
  {% endif %}

  {% if register_view is defined %}
    {{ partial('partials/game', ['game': game.g, 'logged_in': logged_in, 'is_view': game.is_view]) }}
  {% else %}
    {{ partial('partials/game', ['game': game, 'logged_in': logged_in]) }}
  {% endif %}

  {% if loop.last and logged_in %}
    <div class="d-flex align-items-center justify-content-end">
      {% if page.total_pages > 1 %}
        <div class="text-theme mr-5">
          {{ page.current }} / {{ page.total_pages }}
        </div>
      {% endif %}
      {% if page.current > 1 %}
        {{ link_to(router.getRewriteUri() ~ "?page=" ~ page.before, 'Previous', 'class': 'btn btn-sm rounded-0 btn-outline-theme ml-3') }}
      {% endif %}
      {% if page.total_pages > page.current %}
        {{ link_to(router.getRewriteUri() ~ "?page=" ~ page.next, 'Next', 'class': 'btn btn-sm rounded-0 btn-outline-theme ml-3') }}
      {% endif %}
    </div>
  {% endif %}
{% else %}
  <div class="box" id="box-empty">
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
{% endfor %}
