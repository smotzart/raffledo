<main class="pt-50px">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 order-lg-1">
        <div class="raff-sticky-ad">
          <div class="invisible h2 mb-5 d-none d-lg-block">AD</div>
          <div class="d-flex">
            <a href class="d-block mx-auto mb-50px">
              <img src="img/banner.png" alt="MySEO" class="img-fluid">
            </a>
          </div>
        </div>
      </div>
      <div id="toplist" class="col-12 col-lg-9">
        <div class="row">
          <div class="col-12" ng-app="app" ng-controller="AppCtrl">
            {{ content() }}         

            <script type="text/ng-template" id="custom_template.html">
            
            <div class="cg-notify-message d-flex notify-right" ng-click="$close()" ng-class="$classes">
              <div class="notify-icon d-flex align-items-center justify-content-center">
                <i class="fas fa-check"></i>
              </div>
              <div ng-show="!$messageTemplate" ng-bind-html="$message"></div>
              <div ng-show="$messageTemplate" class="cg-notify-message-template">
              </div>
            </div>

            </script>

          </div>
        </div>    
        <div class="text-center mb-g">
          {{ link_to(router.getRewriteUri() ~ '#toplist', 'Nach oben', 'class': 'btn btn-outline-theme px-5', 'data-scroll': 'true' ) }}
        </div> 
      </div>
    </div>
  </div>
</main>