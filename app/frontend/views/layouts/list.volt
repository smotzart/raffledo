<div class="mb-5">
  <h2 class="text-capitalize m-0">{% if search_name %}{{ search_name }}{% else %}Aktuelle Gewinnspiele{% endif %}</h2>
  {% if search_description is defined %}
    <p class="lead">{{ search_description }}</p>
  {% endif %}
</div>

<div class="row mb-65px">
  <div class="col-12 col-lg-3 order-lg-1">
    <div class="d-flex">
      <a href class="d-block mx-auto mb-g"><img src="img/banner.png" alt="MySEO" class="img-fluid"></a>
    </div>
  </div>
  <div class="col-12 col-lg-9">
    {{ content() }}
  </div>
</div>


<div class="row">
  <div class="col-12 col-md-3">
    <h5 class="mb-4 text-theme">Top Preise</h5>
    <ul class="list-unstyled">
      {% for tagItem in tags_footer %}
        <li><a href="/{{ tagItem.tag }}-gewinnspiel" class="text-capitalize text-body">{{ tagItem.name }}</a></li>
      {% endfor %}
    </ul>
  </div>
  <div class="col-12 col-md-6 col-lg-5">
    <h5 class="mb-4 text-theme">Gewinnspiel Anbieter</h5>
    <div class="row">
      <div class="col">                
        <ul class="list-unstyled">
          {% for company in companies_footer %}
            {% if loop.index < 5 %}
              <li><a href="/{{ company.tag }}-gewinnspiele" class="text-capitalize text-body">{{ company.name }}</a></li>
            {% endif %}
          {% endfor %}
        </ul>
      </div>
      <div class="col">                    
        <ul class="list-unstyled">
          {% for company in companies_footer %}
            {% if loop.index > 4 %}
              <li><a href="/{{ company.tag }}-gewinnspiele" class="text-capitalize text-body">{{ company.name }}</a></li>
            {% endif %}
          {% endfor %}
        </ul>
      </div>
    </div>
  </div>
  <div class="col-12 col-md-3">
    <h5 class="mb-4 text-theme">Über Raffledo</h5>       
    <ul class="list-unstyled">
      <li><a href="/impressum" class="text-capitalize text-body">Impressum</a></li>
      <li><a href="/datenschutz" class="text-capitalize text-body">Datenschutz</a></li>
    </ul>
  </div>
</div>