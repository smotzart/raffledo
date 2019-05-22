<div class="d-flex align-items-center pb-2 border-bottom mb-4">
  <h2 class="m-0">Tags</h2>  
  <div class="ml-auto">
    <?= $this->tag->linkTo(['tags/create', '<i class="fa fa-plus mr-2"></i>Create', 'class' => 'btn btn-success']) ?>
  </div>
</div>
<?= $this->flashSession->output() ?>
<div class="container-fluid mb-5">
  <div class="row py-3 bg-light text-muted">
    <div class="col-10">
      <div class="row">
        <div class="col-3 font-weight-bold">Tag</div>
        <div class="col-4 font-weight-bold">Name</div>
        <div class="col-5 font-weight-bold">Description</div>        
      </div>
    </div>
    <div class="col-2 font-weight-bold">Footer</div>
  </div>
  <?php if (($this->length($tags)) > 0) { ?>
    <?php foreach ($tags as $item) { ?>
      <div class="row py-2 border-top">
        <div class="col-10">
          <div class="row align-items-center h-100">
            <div class="col-3"><?= $item->tag ?></div>
            <div class="col-4"><?= $item->name ?></div>
            <div class="col-5"><?= $item->description ?></div>          
          </div>
        </div>
        <div class="col-2 d-flex align-items-center">
          <?php if ($item->footer == 1) { ?>
            <div class="ml-3">
              <i class="fa fa-check-circle text-success"></i>
            </div>
          <?php } ?>
          <?= $this->tag->linkTo(['tags/edit/' . $item->id, '<i class="fa fa-eye"></i>', 'class' => 'btn btn-sm btn-info ml-auto']) ?>
          <?= $this->tag->linkTo(['tags/delete/' . $item->id, '<i class="fa fa-trash-o"></i>', 'class' => 'btn btn-sm btn-danger ml-3']) ?>
        </div>
      </div>
    <?php } ?>
  <?php } else { ?>
    <div class="py-2"><i>Empty list</i></div>
  <?php } ?>
</div>