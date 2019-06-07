<main class="pt-50px">
  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-3 order-lg-1">
        <div class="raff-sticky-ad">
          <div class="invisible h2 mb-5 d-none d-lg-block">AD</div>
          <div class="d-flex">
            {{ ads }}
          </div>
        </div>
      </div>
      <div id="toplist" class="col-12 col-lg-9">
        <div class="row">
          <div class="col-12" ng-app="app" ng-controller="AppCtrl">
            {{ content() }}         

            <div class="modal fade" id="hideTagsModal" tabindex="-1" role="dialog" aria-labelledby="hideCategoriesLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body p-4 p-md-7">
                    <h3 class="text-theme">Kategorie ausblenden</h3>
                    <p class="lead">Welche Tags wollen Sie ausschließen</p>
                    <div class="row">
                      <div class="col-12 col-md-4 mb-7" ng-if="modalGame.tags.length > 0">
                        <div class="custom-control custom-checkbox" ng-repeat="tag in modalGame.tags">
                          <input type="checkbox" class="custom-control-input" name="tags_id[]" checklist-model="tags_id" checklist-value="tag.id" id="customCheck{{ '{{ tag.id }}' }}">
                          <label class="custom-control-label" for="customCheck{{ '{{ tag.id }}' }}">{{ '{{ tag.name }}' }}</label>
                        </div>            
                      </div>
                      <div class="col-12 col-md-4 mb-7">
                        <div ng-if="modalGame.g.type_register == 1" class="custom-control custom-checkbox with-fi">
                          <input type="checkbox" class="custom-control-input" name="types_id[]" checklist-model="types_id" checklist-value="'type_register'" id="check_type_register">
                          <label for="check_type_register" class="custom-control-label"><i tooltip data-toggle="tooltip" data-placement="bottom" title="Registrierung erforderlich" class="fi flaticon-user"></i></label>
                        </div>
                        <div ng-if="modalGame.g.type_sms == 1" class="custom-control custom-checkbox with-fi">
                          <input type="checkbox" class="custom-control-input" name="types_id[]" checklist-model="types_id" checklist-value="'type_sms'" id="check_type_sms">
                          <label for="check_type_sms" class="custom-control-label"><i tooltip data-toggle="tooltip" data-placement="bottom" title="SMS/Anruf erforderlich" class="fi flaticon-tablet"></i></label>
                        </div>
                        <div ng-if="modalGame.g.type_buy == 1" class="custom-control custom-checkbox with-fi">
                          <input type="checkbox" class="custom-control-input" name="types_id[]" checklist-model="types_id" checklist-value="'type_buy'" id="check_type_buy">
                          <label for="check_type_buy" class="custom-control-label"><i tooltip data-toggle="tooltip" data-placement="bottom" title="Produktkauf erforderlich" class="loh"></i></label>
                        </div>
                        <div ng-if="modalGame.g.type_internet == 1" class="custom-control custom-checkbox with-fi">
                          <input type="checkbox" class="custom-control-input" name="types_id[]" checklist-model="types_id" checklist-value="'type_internet'" id="check_type_internet">
                          <label for="check_type_internet" class="custom-control-label"><i tooltip data-toggle="tooltip" data-placement="bottom" title="Online-Spiel" class="fi flaticon-gamepad"></i></label>
                        </div>
                        <div ng-if="modalGame.g.type_submission == 1" class="custom-control custom-checkbox with-fi">
                          <input type="checkbox" class="custom-control-input" name="types_id[]" checklist-model="types_id" checklist-value="'type_submission'" id="check_type_submission">
                          <label for="check_type_submission" class="custom-control-label"><i tooltip data-toggle="tooltip" data-placement="bottom" title="Kreativ-Einsendung erforderlich" class="fi flaticon-idea"></i></label>
                        </div>
                      </div>
                    </div>
                    <button type="button" class="btn btn-secondary mr-3 mb-3" data-dismiss="modal">Abbruch</button>
                    <button type="submit" ng-click="sendModal()" data-dismiss="modal" class="btn btn-theme mb-3">Jetzt ausschließen</button>     
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="reportGameModal" tabindex="-1" role="dialog" aria-labelledby="reportGameLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-body p-4 p-md-7">
                    <h3 class="text-theme">Fehler melden</h3>
                    <p class="lead">Etwas stimmt mit diesem Spiel nicht, dann teilen Sie uns mit was.</p>
                    <div>
                      <div class="form-group">
                        <label for="report">Ihre Nachricht</label>
                        <textarea id="report" name="report" ng-model="reportText" class="form-control" placeholder="Nachricht" rows="4" required="required"></textarea>
                      </div>         
                      <button type="button" class="btn btn-secondary mr-3 mb-3" data-dismiss="modal">Abbruch</button>
                      <button type="button" class="btn btn-theme mb-3" ng-click="sendReport(reportGameId)" data-dismiss="modal">Jetzt absenden</button>          
                    </div>      
                  </div>
                </div>
              </div>
            </div>

            <script type="text/ng-template" id="custom_template.html">            
              <div class="notify">
                <span class="notify-close" ng-click="closeBtn()" aria-hidden="true">&times;</span>
                <div class="notify-icon">
                  <i class="fas fa-check"></i>
                </div>
                <div class="notify-body">
                  <div class="h6" ng-bind-html="title"></div>
                  <p ng-bind-html="message"></p>
                  <a href class="text-underline" ng-if="enableNotify" ng-click="disableNotify()">Nachricht nicht mehr anzeigen</a>
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

