// Append to array, return array
Array.prototype.append = function(el) {
  if (this.push != null) {
    this.push(el);
  }
  return this;
};

angular.module('app', ['ngRoute', 'ngResource', 'ngAnimate', 'ngSanitize', 'checklist-model']).factory('APIGames', [
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
  function(self,
  APIGames,
  APIControl,
  window,
  $timeout) {
    self.data = {};
    self.modalTags = {};
    self.tags_id = [];
    self.showTagSuccess = false;
    (self.getData = function() {
      return APIGames.get({},
  function(data) {
        return self.data = data;
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
  function() {
        var item,
  position;
        game.save_id = true;
        if (self.data.view_type === 'list') {
          position = self.data.collections['regular'].games.indexOf(game);
          item = self.data.collections['regular'].games.splice(position,
  1);
          return self.data.collections['favorite'].games.push(item[0]);
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
  function() {
        var position;
        position = self.data.collections[key].games.indexOf(game);
        return self.data.collections[key].games.splice(position,
  1);
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
      return copyElement.remove();
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
  function() {
        if (self.data.view_type === 'list') {
          self.getData();
        }
        if (((self.data.view_type === tag && tag === 'company')) || ((self.data.view_type === tag && tag === 'tag'))) {
          self.data.collections.regular.entry.is_hide = !self.data.collections.regular.entry.is_hide;
          if (!self.data.collections.regular.entry.is_hide) {
            self.showTagSuccess = true;
            return $timeout(function() {
              return self.showTagSuccess = false;
            },
  3000);
          }
        }
      });
    };
    self.openModal = function(game) {
      return self.modalTags = game.tags;
    };
    self.reportGame = function(game) {
      return self.reportGameId = game.g.id;
    };
    return self.sendModal = function() {
      var control;
      control = new APIControl({
        actionType: 'hideTags',
        tags_id: self.tags_id
      });
      return control.$save({},
  function() {
        return self.getData();
      });
    };
  }
]);
