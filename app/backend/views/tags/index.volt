<div class="d-flex align-items-center pb-2 border-bottom mb-4">
  <h2 class="m-0">Tags</h2>  
  <div class="ml-auto">
    {{ link_to('tags/create', '<i class="fa fa-plus mr-2"></i>Create', 'class': 'btn btn-success') }}
  </div>
</div>
{{ flashSession.output() }}
<div class="container-fluid mb-5">
  <div class="row py-3 bg-light text-muted">
    <div class="col-10">
      <div class="row">
        <div class="col-3 font-weight-bold">Tag</div>
        <div class="col-4 font-weight-bold">Title</div>
        <div class="col-5 font-weight-bold">Description</div>        
      </div>
    </div>
    <div class="col-2 font-weight-bold">Footer</div>
  </div>
  {% if (tags | length) > 0 %}
    {% for item in tags %}
      <div class="row py-2 border-top">
        <div class="col-10">
          <div class="row align-items-center h-100">
            <div class="col-3">{{ item.tag }}</div>
            <div class="col-4">{{ item.title }}</div>
            <div class="col-5">{{ item.description }}</div>          
          </div>
        </div>
        <div class="col-2 d-flex align-items-center">
          {% if item.footer == 1 %}
            <div class="ml-3">
              <i class="fa fa-check-circle text-success"></i>
            </div>
          {% endif %}
          {{ link_to('tags/edit/' ~ item.id, '<i class="fa fa-eye"></i>', 'class': 'btn btn-sm btn-info ml-auto') }}
          {{ link_to('tags/delete/' ~ item.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-sm btn-danger ml-3') }}
        </div>
      </div>
    {% endfor %}
  {% else %}
    <div class="py-2"><i>Empty list</i></div>
  {% endif %}
</div>