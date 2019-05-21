<?php if (($this->length($games)) > 0) { ?>
  <?php foreach ($games as $game) { ?>
    <div class="box">
      <div class="box-body">
        <div class="row no-gutters align-items-center">
          <div class="col-10 col-xl-8 box-title">
            <?= $game->title ?>
          </div>
          <div class="d-none d-xl-block col-12 col-md-3">
            <span class="box-label">Gewinnspiel-Typ</span>
            <div>
              <?php if (($game->type_register == 1)) { ?><i class="fas mr-2 fa-sign-in-alt"></i><?php } ?>              
              <?php if (($game->type_sms == 1)) { ?><i class="fas mr-2 fa-comment-alt text-warning"></i><?php } ?>
              <?php if (($game->type_buy == 1)) { ?><i class="fas mr-2 fa-phone text-warning"></i><?php } ?>
              <?php if (($game->type_internet == 1)) { ?><i class="fas mr-2 fa-shopping-basket"></i><?php } ?>
              <?php if (($game->type_submission == 1)) { ?><i class="fas mr-2 fa-gamepad"></i><?php } ?>
            </div>
          </div>
          <div class="col-2 col-xl-1 text-right">
            <div class="dropdown float-right">
              <a href="#" class="btn btn-link text-secondary" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">Gewinnspiel ausblenden</a>
                <a class="dropdown-item" href="#">Anbieter ausblenden</a>
                <a class="dropdown-item" href="#">Gewinnspiel melden</a>
              </div>
            </div>
          </div>
        </div>
        <hr>
        <div class="row no-gutters">
          <div class="col-12 col-md-7">
            <p><span class="box-label">Anbieter</span> <a href="/<?= $game->company->tag ?>-gewinnspiele" class="text-body"><?= $game->company->name ?></a></p>
            <p><span class="box-label">Preis</span><?= $game->price ?></p>
          </div>
          <div class="col-12 col-md-4 ml-auto">
            <p><span class="box-label">Einsendeschluss</span>1. September 2019</p>
            <p><span class="box-label">Lösungsvorschlag</span><?= $game->suggested_solution ?></p>
          </div>
          <div class="col-12 d-block d-xl-none">
            <span class="box-label">Gewinnspiel-Typ</span>
            <div>
              <?php if (($game->type_register == 1)) { ?><i class="fas mr-2 fa-sign-in-alt"></i><?php } ?>              
              <?php if (($game->type_sms == 1)) { ?><i class="fas mr-2 fa-comment-alt text-warning"></i><?php } ?>
              <?php if (($game->type_buy == 1)) { ?><i class="fas mr-2 fa-phone text-warning"></i><?php } ?>
              <?php if (($game->type_internet == 1)) { ?><i class="fas mr-2 fa-shopping-basket"></i><?php } ?>
              <?php if (($game->type_submission == 1)) { ?><i class="fas mr-2 fa-gamepad"></i><?php } ?>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer d-flex flex-column align-items-md-center flex-md-row">
        <div class="box-btn order-md-1 ml-md-auto">
          <?php if ($logged_in) { ?>
            <a href="" class="btn btn-theme mr-2">Merken</a>
            <a href="" class="btn btn-outline-mute mr-2">Ausblenden</a>
          <?php } ?>
          <a href="/win/<?= $game->id ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-warning">Zum Gewinnspiel</a>
        </div>
        <div class="box-tags order-md-0">
          <?php foreach ($game->tags as $tagItem) { ?>
            <a href="/<?= $tagItem->tag ?>-gewinnspiele" class="text-muted mr-md-4 d-inline-block"><i class="fas fa-tags fa-flip-horizontal fa-xs mr-2"></i><?= $tagItem->title ?></a>
          <?php } ?>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } ?>