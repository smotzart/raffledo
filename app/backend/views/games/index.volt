<div class="d-flex align-items-center pb-2 border-bottom mb-4">
  <h2 class="m-0">Games</h2>  
  <div class="ml-auto">
    {{ link_to('games/create', '<i class="fa fa-plus mr-2"></i>Create', 'class': 'btn btn-success') }}
  </div>
</div>
{{ flashSession.output() }}
<div class="container-fluid mb-5">
  <div class="row py-3 bg-light text-muted">
    <div class="col-10">
      <div class="row">
        <div class="col-4 font-weight-bold">Title</div>
        <div class="col-4 font-weight-bold">Company</div>
        <div class="col-4 font-weight-bold">Type</div>        
      </div>
    </div>
    <div class="col-2 font-weight-bold"></div>
  </div>
  {% if (games | length) > 0 %}
    {% for item in games %}
      <div class="row py-2 border-top">
        <div class="col-10">
          <div class="row align-items-center h-100">
            <div class="col-4">{{ item.title }}</div>
            <div class="col-4">{{ item.company.name }}</div>
            <div class="col-4 d-flex icons-set">
              {% if (item.type_register == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Registrierung erforderlich" class="fi flaticon-user"></i>{% endif %}
              {% if (item.type_sms == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="SMS/Anruf erforderlich" class="fi flaticon-tablet"></i>{% endif %}
              {% if (item.type_buy == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Produktkauf erforderlich" class="loh"></i>{% endif %}
              {% if (item.type_internet == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Online-Spiel" class="fi flaticon-gamepad"></i>{% endif %}
              {% if (item.type_submission == 1) %}<i data-toggle="tooltip" data-placement="bottom" title="Kreativ-Einsendung erforderlich" class="fi flaticon-idea"></i>{% endif %}
            </div>          
          </div>
        </div>
        <div class="col-2 d-flex align-items-center">
          {{ link_to('games/edit/' ~ item.id, '<i class="fa fa-eye"></i>', 'class': 'btn btn-sm btn-info ml-auto') }}
          {{ link_to('games/delete/' ~ item.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-sm btn-danger ml-3') }}
        </div>
      </div>
    {% endfor %}
  {% else %}
    <div class="py-2"><i>Empty list</i></div>
  {% endif %}
</div>