
<?php $title = 0; ?>



<?php $v29779762421iterated = false; ?><?php $v29779762421iterator = $page->items; $v29779762421incr = 0; $v29779762421loop = new stdClass(); $v29779762421loop->self = &$v29779762421loop; $v29779762421loop->length = count($v29779762421iterator); $v29779762421loop->index = 1; $v29779762421loop->index0 = 1; $v29779762421loop->revindex = $v29779762421loop->length; $v29779762421loop->revindex0 = $v29779762421loop->length - 1; ?><?php foreach ($v29779762421iterator as $game) { ?><?php $v29779762421loop->first = ($v29779762421incr == 0); $v29779762421loop->index = $v29779762421incr + 1; $v29779762421loop->index0 = $v29779762421incr; $v29779762421loop->revindex = $v29779762421loop->length - $v29779762421incr; $v29779762421loop->revindex0 = $v29779762421loop->length - ($v29779762421incr + 1); $v29779762421loop->last = ($v29779762421incr == ($v29779762421loop->length - 1)); ?><?php $v29779762421iterated = true; ?>
  
  <?php if ($v29779762421loop->first) { ?>
    <?php if (isset($limited_view) && isset($search_name)) { ?>
      <div class="mb-5">
        <h2 class="m-0"><span class="text-capitalize"><?= $search_name ?></span> <?php if (isset($search_description)) { ?><small class="text-muted"><?= $search_description ?></small><?php } ?></h2>
      </div>
    <?php } elseif (isset($register_view) && $game->save_id) { ?>
      <?php $title = 1; ?>
      <div class="mb-5">
        <h2 class="text-capitalize m-0">Favoriten</h2>
      </div>
    <?php } else { ?>
      <div class="mb-5">
        <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
      </div>
    <?php } ?>
  <?php } ?>

  <?php if ($v29779762421loop->index > 1 && isset($register_view) && !$game->save_id && $title == 1) { ?>
    <?php $title = 0; ?>
    <div class="mb-5">
      <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
    </div>
  <?php } ?>

  <?php if (isset($register_view)) { ?>
    <?= $this->partial('partials/game', ['game' => $game->g, 'logged_in' => $logged_in, 'is_view' => $game->is_view]) ?>
  <?php } else { ?>
    <?= $this->partial('partials/game', ['game' => $game, 'logged_in' => $logged_in]) ?>
  <?php } ?>

  <?php if ($v29779762421loop->last && $logged_in) { ?>
    <div class="d-flex align-items-center justify-content-end">
      <?php if ($page->total_pages > 1) { ?>
        <div class="text-theme mr-5">
          <?= $page->current ?> / <?= $page->total_pages ?>
        </div>
      <?php } ?>
      <?php if ($page->current > 1) { ?>
        <?= $this->tag->linkTo([$this->router->getRewriteUri() . '?page=' . $page->before, 'Previous', 'class' => 'btn btn-sm rounded-0 btn-outline-theme ml-3']) ?>
      <?php } ?>
      <?php if ($page->total_pages > $page->current) { ?>
        <?= $this->tag->linkTo([$this->router->getRewriteUri() . '?page=' . $page->next, 'Next', 'class' => 'btn btn-sm rounded-0 btn-outline-theme ml-3']) ?>
      <?php } ?>
    </div>
  <?php } ?>
<?php $v29779762421incr++; } if (!$v29779762421iterated) { ?>
  <div class="box" id="box-empty">
    <div class="box-body text-center py-7">    
      <div class="row">
        <div class="col-12 col-md-9 col-lg-8 mx-auto">
          <div class="box-label mb-5">Filter aktiv</div>
          <p class="mb-7">Du nutzt einen Filter, dadurch werden nicht alle <br class="d-none d-lg-block">Gewinnspiele angezeigt.</p>
          <a href="/gewinnspiele-zeige-mir-alle-gewinnspiele-die-ich-noch-nicht-ausgeblendet-habe" class="btn btn-block btn-theme">Weitere Gewinnspiele anzeigen</a>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
