<div class="box-header mb-5 d-flex align-items-center">
  <div>
    <h2 class="text-capitalize m-0{% if entry.description is defined and entry.description is not empty %} mb-2{% endif %}">{{ entry.name }}</h2>
    {% if entry.description is defined and entry.description is not empty %}
      <p class="m-0 lh-1">{{ entry.description }}</p>
    {% endif %}    
  </div>
  <div class="ml-auto pl-50px">
    <a href="{{ url('gewinnspiele') }}" class="btn btn-outline-warning"><span class="px-2">&lsaquo;</span><span class="pr-2">Zurück zur Liste</span></a>
  </div>
</div>

{% if hidden_tag is defined %}
  <div class="alert alert-danger text-source d-flex align-items-center" role="alert">
    <div>
      <b>Hinweis:</b> Du hast diesen Anbieter bereits ausgeschlossen und siehst daher keine Gewinnspiele auf deiner persönlichen Startseite.
    </div>
    {% if hidden_type is defined and hidden_type == 'company' %}
      <a href class="btn btn-outline-warning ml-5">Anbieter wieder einblenden</a>
    {% elseif hidden_type is defined and hidden_type == 'tag' %}
      <a href class="btn btn-outline-warning ml-5">Tag wieder einblenden</a>
    {% endif %}
  </div>
{% endif %}

{% for game in games %}
  {{ partial('partials/game-default', ['game': game]) }}
{% endfor %}