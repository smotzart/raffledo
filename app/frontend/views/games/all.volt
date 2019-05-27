{% for game in page.items %}
  
  {{ partial('partials/game', ['game': game, 'logged_in': logged_in]) }}

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
