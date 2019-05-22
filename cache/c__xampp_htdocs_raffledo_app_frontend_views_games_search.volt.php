
<?php $v37719704801iterated = false; ?><?php $v37719704801iterator = $page->items; $v37719704801incr = 0; $v37719704801loop = new stdClass(); $v37719704801loop->self = &$v37719704801loop; $v37719704801loop->length = count($v37719704801iterator); $v37719704801loop->index = 1; $v37719704801loop->index0 = 1; $v37719704801loop->revindex = $v37719704801loop->length; $v37719704801loop->revindex0 = $v37719704801loop->length - 1; ?><?php foreach ($v37719704801iterator as $game) { ?><?php $v37719704801loop->first = ($v37719704801incr == 0); $v37719704801loop->index = $v37719704801incr + 1; $v37719704801loop->index0 = $v37719704801incr; $v37719704801loop->revindex = $v37719704801loop->length - $v37719704801incr; $v37719704801loop->revindex0 = $v37719704801loop->length - ($v37719704801incr + 1); $v37719704801loop->last = ($v37719704801incr == ($v37719704801loop->length - 1)); ?><?php $v37719704801iterated = true; ?>
  <?= $this->partial('partials/game', ['game' => $game, 'logged_in' => $logged_in]) ?>
  <?php if ($v37719704801loop->last) { ?>
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
<?php $v37719704801incr++; } if (!$v37719704801iterated) { ?>
  <p class="lead">No games</p>
<?php } ?>