<div class="box" id="box-{{ game.id }}">
  <div class="box-body">
    <div class="row no-gutters align-items-center">
      <div class="col-12 col-xl-8 box-title">
        {{ game.title }}
      </div>
      <div class="col-12 col-xl-3 d-none d-xl-block">
        {% if game.type_register == 1 or game.type_sms == 1 or game.type_buy == 1 or game.type_internet == 1 or game.type_submission == 1 %}
          <div class="box-label">Gewinnspiel-Typ</div>
        {% endif %}
        <div class="lh-0">
          {% if (game.type_register == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Registrierung erforderlich" class="fi flaticon-user mr-2"></i>{% endif %}
          {% if (game.type_sms == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="SMS/Anruf erforderlich" class="fi flaticon-tablet mr-2"></i>{% endif %}
          {% if (game.type_buy == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Produktkauf erforderlich" class="fi flaticon-shield mr-2"></i>{% endif %}
          {% if (game.type_internet == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Online-Spiel" class="fi flaticon-gamepad mr-2"></i>{% endif %}
          {% if (game.type_submission == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Kreativ-Einsendung erforderlich" class="fi flaticon-idea mr-2"></i>{% endif %}
        </div>
      </div>
    </div>
    <hr>
    <div class="row no-gutters">
      <div class="col-12 col-md-7">
        <p>
          <span class="box-label">Anbieter</span>
          <a href="/{{ game.company.tag }}-gewinnspiele" class="text-body">{{ game.company.name }}</a>
        </p>
        {% if game.price %}
          <p>
            <span class="box-label">{% if game.price_info %}Info{% else %}Preis{% endif %}</span>
            {{ game.price | nl2br }}
          </p>
        {% endif %}
      </div>
      <div class="col-12 col-md-4 ml-auto">
        <p>
          <span class="box-label">Einsendeschluss</span>
          {{ date('j. F Y', strtotime(game.deadline_date)) }}
        </p>
        {% if game.suggested_solution %}
          <p>
            <span class="box-label">Lösungsvorschlag</span>
            {{ link_to('/', 'nur für User sichtbar', 'class': 'text-body' ) }}
          </p>
        {% endif %}
      </div>
      <div class="col-12 d-block d-xl-none">
        {% if game.type_register == 1 or game.type_sms == 1 or game.type_buy == 1 or game.type_internet == 1 or game.type_submission == 1 %}
          <span class="box-label">Gewinnspiel-Typ</span>
        {% endif %}
        <div>
          {% if (game.type_register == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Registrierung erforderlich" class="fi flaticon-user mr-2"></i>{% endif %}
          {% if (game.type_sms == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="SMS/Anruf erforderlich" class="fi flaticon-tablet mr-2"></i>{% endif %}
          {% if (game.type_buy == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Produktkauf erforderlich" class="fi flaticon-shield mr-2"></i>{% endif %}
          {% if (game.type_internet == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Online-Spiel" class="fi flaticon-gamepad mr-2"></i>{% endif %}
          {% if (game.type_submission == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Kreativ-Einsendung erforderlich" class="fi flaticon-idea mr-2"></i>{% endif %}
        </div>
      </div>
    </div>
  </div>
  <div class="box-footer d-flex flex-column align-items-md-center flex-md-row">
    <div class="box-btn order-md-1 ml-md-auto">      
      {{ link_to('/win/' ~ game.id, 'Zum Gewinnspiel', 'target': '_blank', 'rel': 'noopener noreferrer', 'class': 'btn btn-outline-warning') }}
    </div>
    {% if (game.tags | length) > 0 %}
      <div class="box-tags order-md-0">
        {% for item in game.tags %}
          <a href="/{{ item.tag }}-gewinnspiel" class="text-muted mr-md-4 d-inline-block"><i class="fas fa-tags fa-flip-horizontal fa-xs mr-2"></i>{{ item.name }}</a>
        {% endfor %}
      </div>
    {% endif %}
  </div>
</div>