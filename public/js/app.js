// Append to array, return array
Array.prototype.append = function(el) {
  if (this.push != null) {
    this.push(el);
  }
  return this;
};

angular.module('ui-notification');

angular.module('app', ['ngRoute', 'ngResource', 'ngAnimate', 'ngSanitize', 'checklist-model', 'ui-notification']).factory('APIReport', [
  '$resource',
  function($resource) {
    return $resource('games/report/:game_id',
  {
      game_id: '@game_id'
    });
  }
]).factory('APIGames', [
  '$resource',
  function($resource) {
    return $resource('games/get');
  }
]).factory('APIControl', [
  '$resource',
  function($resource) {
    return $resource('games/control',
  {});
  }
]).factory('APIShow', [
  '$resource',
  function($resource) {
    return $resource('games/show/:id',
  {
      id: '@id'
    });
  }
]).config([
  'NotificationProvider',
  function(noty) {
    return noty.setOptions({
      delay: 5000,
      startTop: 120,
      startRight: 15,
      verticalSpacing: 20,
      horizontalSpacing: 20,
      positionX: 'right',
      positionY: 'top',
      closeOnClick: false,
      templateUrl: 'custom_template.html'
    });
  }
]).directive('tooltip', function() {
  return {
    restrict: 'A',
    link: function(scope, element, attrs) {
      return element.hover(function() {
        return element.tooltip('show');
      }, function() {
        return element.tooltip('hide');
      });
    }
  };
}).run(['$rootScope', '$route'].append(function(root, $route) {})).controller('AppCtrl', [
  '$scope',
  'APIGames',
  'APIControl',
  '$window',
  '$timeout',
  'Notification',
  'APIReport',
  function(self,
  APIGames,
  APIControl,
  window,
  $timeout,
  notify,
  APIReport) {
    self.data = null;
    self.modalGame = null;
    self.types_id = [];
    self.tags_id = [];
    self.showTagSuccess = false;
    self.enableNotify = true;
    self.disableNotify = function() {
      var control;
      control = new APIControl({
        actionType: 'notify'
      });
      return control.$save({},
  function() {
        return self.enableNotify = false;
      });
    };
    (self.getData = function() {
      return APIGames.get({},
  function(data) {
        self.data = data;
        return self.enableNotify = data.notify;
      });
    })();
    // fav - show only in list page
    // fav - move only in list page
    self.toFavCollection = function(game) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'save'
      });
      return control.$save({},
  function(data) {
        var item,
  position;
        self.data.all_count = data.all_count;
        if (self.enableNotify) {
          notify({
            title: data.title,
            message: data.message,
            scope: self
          },
  'notify-theme');
        }
        game.save_id = true;
        if (self.data.view_type === 'list') {
          position = self.data.collections['regular'].games.indexOf(game);
          item = self.data.collections['regular'].games.splice(position,
  1);
          return self.data.collections['favorite'].games.push(item[0]);
        }
      },
  function(data) {
        if (self.enableNotify) {
          return notify({
            title: data.data.title,
            message: data.data.message,
            scope: self
          },
  'notify-danger');
        }
      });
    };
    // hide - remove from any list
    self.toHideCollection = function(game,
  key) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'hide'
      });
      return control.$save({},
  function(data) {
        var position;
        self.data.all_count = data.all_count;
        position = self.data.collections[key].games.indexOf(game);
        self.data.collections[key].games.splice(position,
  1);
        if (self.enableNotify) {
          return notify({
            title: data.title,
            message: data.message,
            scope: self
          },
  'notify-light');
        }
      },
  function(data) {
        if (self.enableNotify) {
          return notify({
            title: data.data.title,
            message: data.data.message,
            scope: self
          },
  'notify-danger');
        }
      });
    };
    // view - mark as view that mean pre hide
    self.toViewCollection = function(game) {
      var copyElement,
  range,
  sel;
      game.is_view = true;
      copyElement = document.createElement("span");
      copyElement.appendChild(document.createTextNode(game.g.suggested_solution));
      copyElement.className = 'sr-only';
      angular.element(document.body.append(copyElement));
      range = document.createRange();
      range.selectNodeContents(copyElement);
      sel = window.getSelection();
      sel.removeAllRanges();
      sel.addRange(range);
      document.execCommand('copy');
      copyElement.remove();
      if (self.enableNotify) {
        return notify({
          title: 'Hinweis',
          message: 'Lösungsvorschlag wurde in die Zwischenablage kopiert!',
          scope: self,
          delay: 'no'
        },
  'notify-theme');
      }
    };
    // toggle - show/hide company or tag by id
    self.toggleTagView = function(id,
  tag) {
      var control;
      control = new APIControl({
        actionType: 'toggleTagById',
        tag_id: id,
        tag_type: tag
      });
      return control.$save({},
  function(data) {
        self.data.all_count = data.all_count;
        if (self.data.view_type === 'list') {
          self.getData();
        }
        if (((self.data.view_type === tag && tag === 'company')) || ((self.data.view_type === tag && tag === 'tag'))) {
          self.data.collections.regular.entry.is_hide = !self.data.collections.regular.entry.is_hide;
          if (!self.data.collections.regular.entry.is_hide) {
            self.showTagSuccess = true;
            $timeout(function() {
              return self.showTagSuccess = false;
            },
  3000);
          }
        }
        if (self.enableNotify) {
          return notify({
            title: data.title,
            message: data.message,
            scope: self
          },
  'notify-success');
        }
      });
    };
    self.openModal = function(game) {
      console.log(self);
      return self.modalGame = game;
    };
    self.reportGame = function(game) {
      return self.reportGameId = game.g.id;
    };
    self.sendReport = function() {
      var report;
      report = new APIReport({
        text: self.reportText
      });
      return report.$save({
        game_id: self.reportGameId
      },
  function(data) {
        if (self.enableNotify) {
          return notify({
            title: data.title,
            message: data.message,
            scope: self
          },
  'notify-success');
        }
      },
  function(data) {
        if (self.enableNotify) {
          return notify({
            title: data.data.title,
            message: data.data.message,
            scope: self
          },
  'notify-danger');
        }
      });
    };
    self.sendModal = function() {
      var control;
      control = new APIControl({
        actionType: 'hideTags',
        tags_id: self.tags_id,
        types_id: self.types_id
      });
      return control.$save({},
  function(data) {
        if (self.enableNotify) {
          notify({
            title: data.title,
            message: data.message,
            scope: self
          },
  'notify-success');
        }
        return self.getData();
      });
    };
    return self.checkCat = function(game) {
      return game.tags.length > 0 || game.g.type_register === 1 || game.g.type_sms === 1 || game.g.type_buy === 1 || game.g.type_internet === 1 || game.g.type_submission === 1;
    };
  }
]);
