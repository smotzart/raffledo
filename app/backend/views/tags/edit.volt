<form method="post" autocomplete="off">
  <div class="d-flex align-items-center pb-2 border-bottom mb-4">
    <h2 class="m-0"><i class="fa fa-hashtag" style="font-size:0.75em"></i>{{ itemTag.tag }} <small>{{ itemTag.name }}</small></h2>  
    <div class="ml-auto mr-2">
      {{ link_to('tags/', '<i class="fa fa-angle-left mr-2"></i>Back', 'class': 'btn btn-outline-info') }}
    </div>
    <div class="mr-2">
      <a href data-tagid="{{ itemTag.id }}" data-tagname="{{ itemTag.name }}" data-toggle="modal" data-target="#removeTag" class="btn btn-outline-danger"><i class="fa fa-trash-o"></i></a>
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
    <label for="name">Name</label>
    {{ form.render("name", ['class': 'form-control']) }}
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
    <a href data-tagid="{{ itemTag.id }}" data-tagname="{{ itemTag.name }}" data-toggle="modal" data-target="#removeTag" class="btn btn-outline-danger"><i class="fa fa-trash-o mr-2"></i>Delete</a>
    <button type="submit" class="btn btn-success"><i class="fa fa-save mr-2"></i>Save</button>
  </div>
</form>

<div class="modal fade" id="removeTag" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">     
      <div class="modal-body">
        <div class="text-center">Sind Sie sicher, dass Sie den Tag <b class="d-block" id="modal-tag-name"></b> löschen wollen?</div>
      </div>
      <div class="modal-footer">
        <div class="row w-100 no-gutters">
          <div class="col pr-2">
            <form action="{{ url('tags/delete') }}" method="post">
              <input type="hidden" name="tagId" value="" id="tagId" />
              <button type="submit" class="btn btn-block btn-success">Ja</button>
            </form>
          </div>
          <div class="col pl-2">
            <button type="button" class="btn btn-outline-danger btn-block" data-dismiss="modal">Nein</button>
          </div>
        </div>        
      </div>
    </div>
  </div>
</div>