<?php $order = 0; ?>

<?php if (isset($register_view)) { ?>
  
  <div id="favs-games">
    <div class="box-header mb-5 <?php if (isset($favs) && ($this->length($favs)) > 0) { ?>d-block<?php } else { ?>d-none<?php } ?>">
      <h2 class="text-capitalize m-0">Favoriten</h2>
    </div>
    <div id="favs-games-body" class="box-parent favs">
      <?php if (isset($favs)) { ?>
        <?php foreach ($favs as $game) { ?>
          <?= $this->partial('partials/game', ['lindex' => $order, 'game' => $game->g, 'logged_in' => $logged_in, 'is_view' => $game->is_view]) ?>
          <?php $order = $order + 1; ?>
        <?php } ?>
      <?php } ?>
    </div>
  </div>

<?php } ?>

<div id="regular-games" <?php if (isset($limited_view)) { ?>class="limited-view"<?php } ?>>
  <?php if (isset($limited_view) && isset($search_name)) { ?>
    <div class="box-header mb-5">
      <h2 class="m-0"><span class="text-capitalize"><?= $search_name ?></span> <?php if (isset($search_description)) { ?><small class="text-muted"><?= $search_description ?></small><?php } ?></h2>
    </div>
  <?php } else { ?>
    <div class="box-header mb-5 d-<?php if (($this->length($games)) == 0 && (isset($favs) && ($this->length($favs)) > 0)) { ?>none<?php } else { ?>block<?php } ?>">
      <h2 class="text-capitalize m-0">Aktuelle Gewinnspiele</h2>
    </div>
  <?php } ?>
  <div id="regular-games-body" class="box-parent regular">
    <?php foreach ($games as $game) { ?>

      <?php if (isset($register_view)) { ?>
        <?= $this->partial('partials/game', ['lindex' => $order, 'game' => $game->g, 'logged_in' => $logged_in, 'is_view' => $game->is_view]) ?>
      <?php } else { ?>
        <?= $this->partial('partials/game', ['lindex' => $order, 'game' => $game, 'logged_in' => $logged_in]) ?>
      <?php } ?>
      <?php $order = $order + 1; ?>

    <?php } ?>
  </div>
  <div id="regular-games-empty" class="box d-<?php if ((!isset($favs) || ($this->length($favs)) == 0) && (($this->length($games)) == 0 || !isset($games))) { ?>block<?php } else { ?>none<?php } ?>" id="box-empty">
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
</div>
