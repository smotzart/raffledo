
<div class="box" id="box-{{ game.id }}" data-order="{{ lindex }}">
  <div class="d-none">
  order-{{ lindex }} 
</div>
  <div class="box-body">
    <div class="row no-gutters align-items-center">
      <div class="col-10 col-xl-8 box-title">
        {{ game.title }}
      </div>
      <div class="d-none d-xl-block col-12 col-md-3">
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
      <div class="col-2 col-xl-1 text-right">
        {% if logged_in %}
          <div class="dropdown float-right">
            <a href="#" class="btn btn-link text-secondary py-2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <form action="games/control" method="post" accept-charset="utf-8">
                <input type="hidden" name="actionType" value="hideCompany" />
                <input type="hidden" name="actionId" value="{{ game.id }}" />
                <button type="submit" class="dropdown-item border-0">Anbieter ausblenden</button>
              </form>
              {% if ( game.tags | length ) > 0 %}
                {% if ( game.tags | length ) > 1 %}
                  <a href data-gameid="{{ game.id }}" class="dropdown-item" data-toggle="modal" data-target="#hideTagsModal">Tags/Preise ausschließen</a>
                {% else %}                
                  <form action="games/control" method="post" accept-charset="utf-8">
                    <input type="hidden" name="actionType" value="hideTags" />
                    <input type="hidden" name="tags_id[]" value="{{ game.tags[0].id }}" />
                    <button type="submit" class="dropdown-item">Tags/Preise ausschließen</button>
                  </form>
                {% endif %}
              {% endif %}
              <a href data-gameid="{{ game.id }}" class="dropdown-item" data-toggle="modal" data-target="#reportGameModal">Gewinnspiel melden</a>
            </div>
          </div>
        {% endif %}
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
        <p><span class="box-label">Einsendeschluss</span>{{ date('j. F Y', strtotime(game.deadline_date)) }}</p>
        {% if game.suggested_solution %}
          <p><span class="box-label">Lösungsvorschlag</span><span id="view-game-{{ game.id }}">{{ game.suggested_solution }}</span></p>
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
    <div class="box-btn order-md-1 ml-md-auto flex-wrap flex-md-nowrap">
      {% if logged_in %}
        <form method="post" action="games/control" accept-charset="utf-8" class="box-save-form w-50 w-md-auto pr-1 pr-md-0 mr-md-2">
          <input type="hidden" name="actionType" value="save" />
          <input type="hidden" name="actionId" value="{{ game.id }}" />
          <button type="submit" class="btn btn-theme btn-block box-save-btn">Merken</button>
        </form>
        {% if is_view is not defined %}
          <form method="post" action="games/control" accept-charset="utf-8" class="box-hide-form w-50 w-md-auto game-hide-control pl-1 pl-md-0 mr-md-2">
            <input type="hidden" name="actionType" value="hide" />
            <input type="hidden" name="actionId" value="{{ game.id }}" />
            <button type="submit" class="btn btn-outline-mute btn-block box-hide-btn">Ausblenden</button>
          </form>
        {% endif %}
      {% endif %}
      {{ link_to('/win/' ~ game.id, 'Zum Gewinnspiel', 'target': '_blank', 'rel': 'noopener noreferrer', 'data-game': game.id, 'class': 'view-game btn w-100 w-md-auto btn-outline-warning') }}
    </div>
    {% if (game.tags | length) > 0 %}
      <div class="box-tags order-md-0">
        {% for tagItem in game.tags %}
          <a href="/{{ tagItem.tag }}-gewinnspiel" class="text-muted mr-md-4 d-inline-block"><i class="fas fa-tags fa-flip-horizontal fa-xs mr-2"></i>{{ tagItem.name }}</a>
        {% endfor %}
      </div>
    {% endif %}
  </div>
</div>