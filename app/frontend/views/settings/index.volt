<div class="mb-5 d-flex align-items-center">
  <div>
    <h2 class="text-capitalize m-0">Einstellungen</h2>
  </div>

  <div class="ml-auto pl-50px">
    <a href="{{ url('gewinnspiele') }}" class="btn btn-outline-warning"><span class="px-2">&lsaquo;</span><span class="pr-2">Zurück zur Liste</span></a>
  </div>
</div>
{{ flashSession.output() }}

<div class="row mb-65px">
  <div class="col-12 mb-5">
    {{ content() }}
  </div>

  <div class="col-12">
    <form action="einstellungen/user" method="post" accept-charset="utf-8">
      <div class="row">
        <div class="col mb-7">
          <h4 class="text-theme mb-3">Sorting</h4>
          <div class="row">
            <div class="col">
              {{ form.render("sort_type", ['class': 'form-control form-control-sm']) }}
            </div>
            <div class="col">
              {{ form.render("Save") }}              
            </div>
          </div>
        </div>
        <div class="col mb-7">
          <h4 class="text-theme mb-3">Notification</h4>
          <div class="row">
            <div class="col">
              {{ form.render("notify", ['class': 'form-control form-control-sm']) }}
            </div>
            <div class="col">
              {{ form.render("Save") }}              
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  {% if saved is defined %}
    {% for save in saved %}
      {% if loop.first %}
        <div class="col-12 col-md-6 col-lg-5 mb-7">
          <h4 class="text-theme mb-3">Saved games</h4>
          <div>
            <ul class="list-group list-group-flush">      
        {% endif %}
          <li class="list-group-item d-flex justify-content-between align-items-center pl-0">{{ save.games.title }} {{ link_to('einstellungen/undo/save/' ~ save.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
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
          <li class="list-group-item d-flex justify-content-between align-items-center pl-0">{{ hide.games.title }} {{ link_to('einstellungen/undo/hide/' ~ hide.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
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
          <li class="list-group-item d-flex justify-content-between align-items-center pl-0">{{ company.company.name }} {{ link_to('einstellungen/undo/company/' ~ company.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
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
          <li class="list-group-item d-flex justify-content-between align-items-center pl-0">{{ item.tag_entry.name }} {{ link_to('einstellungen/undo/tag/' ~ item.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
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
          <li class="list-group-item d-flex justify-content-between align-items-center pl-0">{{ item.game.title }} {{ link_to('einstellungen/undo/view/' ~ item.id, 'Undo', 'class': 'btn btn-sm btn-outline-secondary') }}
        {% if loop.last %}
            </ul>
          </div>
        </div>
        <div class="w-100"></div>
      {% endif %}
    {% endfor %}
  {% endif %}

</div>