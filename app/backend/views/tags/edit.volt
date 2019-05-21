<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0"><i class="fa fa-hashtag" style="font-size:0.75em"></i>{{ itemTag.tag }} <small>{{ itemTag.title }}</small></h2>  
    <div class="ml-auto mr-2">
      {{ link_to('tags/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div class="mr-2">
      {{ link_to('tags/delete/' ~ itemTag.id, '<i class="fa fa-trash-o"></i>', 'class': 'btn btn-outline-danger') }}
    </div>
    <div>
      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
    </div>
  </div>

  {{ content() }}

  <div class="form-group">
    <label for="tag">Tag</label>
    {{ form.render("tag", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="title">Title</label>
    {{ form.render("title", ['class': 'form-control']) }}
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    {{ form.render("description", ['class': 'form-control']) }}
  </div>
  <div class="form-group form-check">
    {{ form.render('footer', ['class': 'form-check-input']) }}
    {{ form.label('footer', ['class': 'form-check-label']) }}
  </div>
  <div class="form-group">
    {{ link_to('tags/delete/' ~ itemTag.id, '<i class="fa fa-trash-o mr-2"></i>Delete', 'class': 'btn btn-outline-danger') }}
    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
  </div>
</form>