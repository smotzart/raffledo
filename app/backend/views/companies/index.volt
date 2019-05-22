<div class="d-flex align-items-center pb-2 border-bottom mb-4">
  <h2 class="m-0">Companies</h2>  
  <div class="ml-auto">
    {{ link_to('companies/create', '<i class="fa fa-plus mr-2"></i>Create', 'class': 'btn btn-success') }}
  </div>
</div>
{{ flashSession.output() }}
<div class="container-fluid mb-5">
  <div class="row py-3 bg-light text-muted">
    <div class="col-10">
      <div class="row">
        <div class="col-3 font-weight-bold">Name</div>
        <div class="col-3 font-weight-bold">Tag</div>
        <div class="col-6 font-weight-bold">Host</div>       
      </div>
    </div>
    <div class="col-2 font-weight-bold">Footer</div>
  </div>
  {% if (companies | length) > 0 %}
    {% for item in companies %}
      <div class="row py-2 border-top">
        <div class="col-10">
          <div class="row align-items-center h-100">
            <div class="col-3">{{ item.name }}</div>
            <div class="col-3">{{ item.tag }}</div>
            <div class="col-6">
              {{link_to(item.host, '<i class="fa fa-external-link-square"></i>', 'class': 'mr-2 float-left')}}
              <div class="text-truncate">{{ item.host }}</div>
            </div>          
          </div>
        </div>
        <div class="col-2 d-flex align-items-center">
          {% if item.footer == 1 %}
            <div class="ml-3">
              <i class="fa fa-check-circle text-success"></i>
            </div>
          {% endif %}
          {{ link_to('companies/edit/' ~ item.id, '<i class="fa fa-eye"></i>', 'class': 'btn btn-sm btn-info ml-auto') }}
          {{ link_to('companies/delete/' ~ item.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-sm btn-danger ml-3') }}
        </div>
      </div>
    {% endfor %}
  {% else %}
    <div class="py-2"><i>Empty list</i></div>
  {% endif %}
</div>