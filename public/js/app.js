// Append to array, return array
Array.prototype.append = function(el) {
  if (this.push != null) {
    this.push(el);
  }
  return this;
};

angular.module('app', ['ngRoute', 'ngResource', 'checklist-model']).factory('APIGames', [
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
]).run(['$rootScope', '$route'].append(function(root, $route) {
  return console.log("<-run->");
})).controller('AppCtrl', [
  '$scope',
  'APIGames',
  'APIControl',
  '$window',
  function(self,
  APIGames,
  APIControl,
  window) {
    self.data = {};
    self.modalTags = {};
    self.tags_id = [];
    console.log(location.pathname);
    APIGames.get({
      "path": window.location.pathname
    },
  function(data) {
      return self.data = data;
    });
    self.toggleSave = function(game,
  key) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'save'
      });
      return control.$save({},
  function() {
        var item,
  position;
        position = self.data.collections[key].games.indexOf(game);
        item = self.data.collections[key].games.splice(position,
  1);
        return self.data.collections[key === 'regular' ? 'favorite' : 'regular'].games.push(item[0]);
      });
    };
    self.hideGame = function(game,
  key) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'hide'
      });
      return control.$save({},
  function() {
        var item,
  position;
        position = self.data.collections[key].games.indexOf(game);
        return item = self.data.collections[key].games.splice(position,
  1);
      });
    };
    self.showGame = function(game) {
      if (!game.is_view) {
        game.is_view = true;
      }
      return window.open('/win/' + game.g.id);
    };
    self.hideCompany = function(game) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'hideCompany'
      });
      return control.$save({},
  function() {
        return APIGames.get({},
  function(data) {
          return self.data = data;
        });
      });
    };
    self.hideTag = function(game) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'hideTags',
        tags_id: self.tags_id
      });
      return control.$save({},
  function() {
        return APIGames.get({
          "path": window.location.pathname
        },
  function(data) {
          return self.data = data;
        });
      });
    };
    self.openModal = function(game) {
      return self.modalTags = game.tags;
    };
    return self.sendModal = function() {
      var control;
      control = new APIControl({
        actionType: 'hideTags',
        tags_id: self.tags_id
      });
      return control.$save({},
  function() {
        return APIGames.get({
          "path": window.location.pathname
        },
  function(data) {
          return self.data = data;
        });
      });
    };
  }
]);

//# sourceMappingURL=app.js.map
