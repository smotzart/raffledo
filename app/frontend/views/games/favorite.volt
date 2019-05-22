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
  <p class="lead">No games</p>
{% endfor %}