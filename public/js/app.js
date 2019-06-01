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
    return $resource('games/get/:value/:tag',
  {
      value: '@value',
      tag: '@tag'
    });
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
]).run(['$rootScope', '$route'].append(function(root, $route) {})).controller('AppCtrl', [
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
    self.$watch('initValue',
  function() {
      return self.getData(self.initValue,
  self.initName);
    });
    self.data = {};
    self.modalTags = {};
    self.tags_id = [];
    self.showTagSuccess = false;
    self.getData = function(value,
  tag) {
      var params;
      params = value && tag ? {
        value: value,
        tag: tag
      } : {};
      return APIGames.get(params,
  function(data) {
        return self.data = data;
      });
    };
    self.toggleTagView = function(id,
  tag) {
      var control;
      control = new APIControl({
        actionType: 'toggleTagById',
        tag_type: tag,
        tag_id: id
      });
      return control.$save({},
  function() {
        if (tag === self.initName) {
          self.data.entry_hide = !self.data.entry_hide;
          if (!self.data.entry_hide) {
            self.showTagSuccess = true;
            return $timeout(function() {
              return self.showTagSuccess = false;
            },
  3000);
          }
        } else {
          console.log("tt");
          return self.getData();
        }
      },
  function() {
        return console.log('not process');
      });
    };
    self.toggleSave = function(game) {
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
        if (!self.initValue) {
          position = self.data.collections['regular'].games.indexOf(game);
          item = self.data.collections['regular'].games.splice(position,
  1);
          return self.data.collections['favorite'].games.push(item[0]);
        }
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
        if (!self.initValue) {
          position = self.data.collections[key].games.indexOf(game);
          return item = self.data.collections[key].games.splice(position,
  1);
        }
      });
    };
    self.showGame = function(game) {
      if (!game.is_view) {
        return game.is_view = true;
      }
    };
    self.hideCompany = function(game) {
      var control;
      control = new APIControl({
        actionId: game.g.id,
        actionType: 'hideCompany'
      });
      return control.$save({},
  function() {
        if (!self.initValue) {
          return APIGames.get({},
  function(data) {
            return self.data = data;
          });
        }
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
        if (!self.initValue) {
          return APIGames.get({
            "path": window.location.pathname
          },
  function(data) {
            return self.data = data;
          });
        }
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
        if (!self.initValue) {
          return APIGames.get({
            "path": window.location.pathname
          },
  function(data) {
            return self.data = data;
          });
        }
      });
    };
  }
]).controller('TagCtrl', [
  '$scope',
  'APIGames',
  'APIControl',
  '$window',
  function(self,
  APIGames,
  APIControl,
  window) {
    return self.$watch('tag_hide',
  function() {
      return console.log(self.tag_hide);
    });
  }
]);
