<header id="header" class="header mb-5">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      {{ link_to(null, 'class': 'navbar-brand', 'Raffledo')}}
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav mr-auto">
          {%- set menus = [
            {'title': 'Games', 'controller': 'games', 'icon': '<i class="fa fa-gamepad mr-2 text-primary"></i>'},
            {'title': 'Tags', 'controller': 'tags', 'icon': '<i class="fa fa-hashtag mr-2 text-warning"></i>'},
            {'title': 'Companies', 'controller': 'companies', 'icon': '<i class="fa fa-group mr-2 text-success"></i>'},
            {'title': 'New game', 'controller': 'new', 'icon': '<i class="fa fa-bullhorn mr-2 text-info"></i>'},
            {'title': 'Reports', 'controller': 'reports', 'icon': '<i class="fa fa-bug mr-2 text-danger"></i>'}
          ] -%}

          {%- for item in menus %}
            {% if item['controller'] == dispatcher.getControllerName() %}
              <li class="nav-item active">{{ link_to(item['controller'], item['icon'] ~ item['title'], 'class': 'nav-link') }}</li>
            {% else %}
              <li class="nav-item">{{ link_to(item['controller'], item['icon'] ~ item['title'], 'class': 'nav-link') }}</li>
            {% endif %}
          {%- endfor -%}
        </ul>
        <ul class="navbar-nav">
          <li class="nav-item active">{{ link_to('session/logout', 'Logout', 'class': 'nav-link') }}</li>            
        </ul>
      </div>
    </div>
  </nav>  
</header>

<div class="container">
  {{ content() }}
</div>  