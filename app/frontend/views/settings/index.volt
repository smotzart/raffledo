<div class="mb-5">
  <h2 class="text-capitalize m-0">Einstellungen</h2>
</div>
{{ flashSession.output() }}

<div class="row mb-65px">
  <div class="col-12 mb-5">
    {{ content() }}
  </div>

  {% if notification == 0 %}
    <div class="col-12 col-md-6 col-lg-5 mb-7">
      <h4 class="text-theme mb-3">Notification</h4>
      {{ link_to('einstellungen/undo/notify/enable', 'Enable notification messages') }}
    </div>
    <div class="w-100"></div>
  {% endif %}
  
  {% if saved is defined %}
    {% for save in saved %}
      {% if loop.first %}
        <div class="col-12 col-md-6 col-lg-5 mb-7">
          <h4 class="text-theme mb-3">Saved games</h4>
          <div>
            <ul class="list-group list-group-flush">      
        {% endif %}
          <li class="list-group-item d-flex justify-content-between align-items-center">{{ save.games.title }} {{ link_to('einstellungen/undo/save/' ~ save.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
        {% if loop.last %}
            </ul>
          </div>
        </div>
        <div class="w-100"></div>
      {% endif %}
    {% endfor %}
  {% endif %}

  {% if hidden is defined %}
    {% for hide in hidden %}
      {% if loop.first %}
        <div class="col-12 col-md-6 col-lg-5 mb-7">
          <h4 class="text-theme mb-3">Hidden games</h4>
          <div>
            <ul class="list-group list-group-flush">      
        {% endif %}
          <li class="list-group-item d-flex justify-content-between align-items-center">{{ hide.games.title }} {{ link_to('einstellungen/undo/hide/' ~ hide.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
        {% if loop.last %}
            </ul>
          </div>
        </div>
        <div class="w-100"></div>
      {% endif %}
    {% endfor %}
  {% endif %}
  
  {% if companies is defined %}
    {% for company in companies %}
      {% if loop.first %}
        <div class="col-12 col-md-6 col-lg-5 mb-7">
          <h4 class="text-theme MB-3">Hidden companies</h4>
          <div>
            <ul class="list-group list-group-flush">      
        {% endif %}
          <li class="list-group-item d-flex justify-content-between align-items-center">{{ company.company.name }} {{ link_to('einstellungen/undo/company/' ~ company.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
        {% if loop.last %}
            </ul>
          </div>
        </div>
        <div class="w-100"></div>
      {% endif %}
    {% endfor %}
  {% endif %}

  {% if tags is defined %}
    {% for item in tags %}
      {% if loop.first %}
        <div class="col-12 col-md-6 col-lg-5 mb-7">
          <h4 class="text-theme mb-3">Hidden tags</h4>
          <div>
            <ul class="list-group list-group-flush">      
        {% endif %}
          <li class="list-group-item d-flex justify-content-between align-items-center">{{ item.tag_entry.name }} {{ link_to('einstellungen/undo/tag/' ~ item.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
        {% if loop.last %}
            </ul>
          </div>
        </div>
        <div class="w-100"></div>
      {% endif %}
    {% endfor %}
  {% endif %}

  {% if viewed is defined %}
    {% for item in viewed %}
      {% if loop.first %}
        <div class="col-12 col-md-6 col-lg-5 mb-7">
          <h4 class="text-theme mb-3">Viewed games</h4>
          <div>
            <ul class="list-group list-group-flush">      
        {% endif %}
          <li class="list-group-item d-flex justify-content-between align-items-center">{{ item.game.title }} {{ link_to('einstellungen/undo/view/' ~ item.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
        {% if loop.last %}
            </ul>
          </div>
        </div>
        <div class="w-100"></div>
      {% endif %}
    {% endfor %}
  {% endif %}

</div>