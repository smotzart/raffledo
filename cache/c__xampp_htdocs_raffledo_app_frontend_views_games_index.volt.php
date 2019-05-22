<?php $v29779762421iterated = false; ?><?php $v29779762421iterator = $page->items; $v29779762421incr = 0; $v29779762421loop = new stdClass(); $v29779762421loop->self = &$v29779762421loop; $v29779762421loop->length = count($v29779762421iterator); $v29779762421loop->index = 1; $v29779762421loop->index0 = 1; $v29779762421loop->revindex = $v29779762421loop->length; $v29779762421loop->revindex0 = $v29779762421loop->length - 1; ?><?php foreach ($v29779762421iterator as $game) { ?><?php $v29779762421loop->first = ($v29779762421incr == 0); $v29779762421loop->index = $v29779762421incr + 1; $v29779762421loop->index0 = $v29779762421incr; $v29779762421loop->revindex = $v29779762421loop->length - $v29779762421incr; $v29779762421loop->revindex0 = $v29779762421loop->length - ($v29779762421incr + 1); $v29779762421loop->last = ($v29779762421incr == ($v29779762421loop->length - 1)); ?><?php $v29779762421iterated = true; ?>

  <?= $this->partial('partials/game', ['game' => $game, 'logged_in' => $logged_in]) ?>

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
  <p class="lead">No games</p>
<?php } ?>