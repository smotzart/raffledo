<header id="header" class="header mb-5">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <?= $this->tag->linkTo([null, 'class' => 'navbar-brand', 'Raffledo']) ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto"><?php $menus = [['title' => 'Games', 'controller' => 'backend/games', 'icon' => '<i class="fa fa-gamepad mr-2 text-primary"></i>'], ['title' => 'Tags', 'controller' => 'backend/tags', 'icon' => '<i class="fa fa-hashtag mr-2 text-warning"></i>'], ['title' => 'Companies', 'controller' => 'backend/companies', 'icon' => '<i class="fa fa-group mr-2 text-success"></i>'], ['title' => 'Reports', 'controller' => 'backend/reports', 'icon' => '<i class="fa fa-exclamation-triangle mr-2 text-danger"></i>']]; ?><?php foreach ($menus as $item) { ?>
            <?php if ($item['controller'] == $this->dispatcher->getControllerName()) { ?>
              <li class="nav-item active"><?= $this->tag->linkTo([$item['controller'], $item['icon'] . $item['title'], 'class' => 'nav-link']) ?></li>
            <?php } else { ?>
              <li class="nav-item"><?= $this->tag->linkTo([$item['controller'], $item['icon'] . $item['title'], 'class' => 'nav-link']) ?></li>
            <?php } ?><?php } ?></ul>
        <ul class="navbar-nav">
          <li class="nav-item active"><?= $this->tag->linkTo(['/login/logout', 'Logout', 'class' => 'nav-link']) ?></li>            
        </ul>
      </div>
    </div>
  </nav>  
</header>

<div class="container">
  <?= $this->getContent() ?>
</div>  