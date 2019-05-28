<div class="mb-5">
  <h2 class="text-capitalize m-0">Einstellungen</h2>
</div>

<div class="row mb-65px">
  <div class="col-12 mb-5">
    {{ content() }}
  </div>
  

  {% for save in saved %}
    {% if loop.first %}
      <div class="col-12 col-md-6 col-lg-5 mb-7">
        <h4 class="text-theme mb-3">Saved games</h4>
        <div>
          <ul class="list-group list-group-flush">      
      {% endif %}
        <li class="list-group-item d-flex justify-content-between align-items-center">{{ save.games.title }} <a href="" class="btn btn-sm btn-outline-secondary">Undo</a></li>
      {% if loop.last %}
          </ul>
        </div>
      </div>
      <div class="w-100"></div>
    {% endif %}
  {% endfor %}

  {% for hide in hidden %}
    {% if loop.first %}
      <div class="col-12 col-md-6 col-lg-5 mb-7">
        <h4 class="text-theme mb-3">Hidden games</h4>
        <div>
          <ul class="list-group list-group-flush">      
      {% endif %}
        <li class="list-group-item d-flex justify-content-between align-items-center">{{ hide.games.title }} <a href="" class="btn btn-sm btn-outline-secondary">Undo</a></li>
      {% if loop.last %}
          </ul>
        </div>
      </div>
      <div class="w-100"></div>
    {% endif %}
  {% endfor %}
  
  {% for company in companies %}
    {% if loop.first %}
      <div class="col-12 col-md-6 col-lg-5 mb-7">
        <h4 class="text-theme MB-3">Hidden companies</h4>
        <div>
          <ul class="list-group list-group-flush">      
      {% endif %}
        <li class="list-group-item d-flex justify-content-between align-items-center">{{ company.company.name }} <a href="" class="btn btn-sm btn-outline-secondary">Undo</a></li>
      {% if loop.last %}
          </ul>
        </div>
      </div>
      <div class="w-100"></div>
    {% endif %}
  {% endfor %}

  {% for item in tags %}
    {% if loop.first %}
      <div class="col-12 col-md-6 col-lg-5 mb-7">
        <h4 class="text-theme mb-3">Hidden tags</h4>
        <div>
          <ul class="list-group list-group-flush">      
      {% endif %}
        <li class="list-group-item d-flex justify-content-between align-items-center">{{ item.tag_entry.name }} <a href="" class="btn btn-sm btn-outline-secondary">Undo</a></li>
      {% if loop.last %}
          </ul>
        </div>
      </div>
      <div class="w-100"></div>
    {% endif %}
  {% endfor %}

  {% for item in viewed %}
    {% if loop.first %}
      <div class="col-12 col-md-6 col-lg-5 mb-7">
        <h4 class="text-theme mb-3">Viewed games</h4>
        <div>
          <ul class="list-group list-group-flush">      
      {% endif %}
        <li class="list-group-item d-flex justify-content-between align-items-center">{{ item.game.title }} <a href="" class="btn btn-sm btn-outline-secondary">Undo</a></li>
      {% if loop.last %}
          </ul>
        </div>
      </div>
      <div class="w-100"></div>
    {% endif %}
  {% endfor %}

</div>