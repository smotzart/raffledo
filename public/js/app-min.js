Array.prototype.append=function(t){return null!=this.push&&this.push(t),this},angular.module("app",["ngRoute","ngResource","ngAnimate","ngSanitize","checklist-model"]).factory("APIGames",["$resource",function(t){return t("games/get/:value/:tag",{value:"@value",tag:"@tag"})}]).factory("APIControl",["$resource",function(t){return t("games/control",{})}]).run(["$rootScope","$route"].append(function(t,n){})).controller("AppCtrl",["$scope","APIGames","APIControl","$window","$timeout",function(t,n,e,a,i){return t.$watch("initValue",function(){return t.getData(t.initValue,t.initName)}),t.data={},t.modalTags={},t.tags_id=[],t.showTagSuccess=!1,t.getData=function(e,a){var i;return i=e&&a?{value:e,tag:a}:{},n.get(i,function(n){return t.data=n})},t.toggleTagView=function(n,a){return new e({actionType:"toggleTagById",tag_type:a,tag_id:n}).$save({},function(){if(a===t.initName&&(t.data.entry_hide=!t.data.entry_hide,!t.data.entry_hide))return t.showTagSuccess=!0,i(function(){return t.showTagSuccess=!1},3e3)},function(){return console.log("not process")})},t.toggleSave=function(n){return new e({actionId:n.g.id,actionType:"save"}).$save({},function(){var e,a;if(n.save_id=!0,!t.initValue)return a=t.data.collections.regular.games.indexOf(n),e=t.data.collections.regular.games.splice(a,1),t.data.collections.favorite.games.push(e[0])})},t.hideGame=function(n,a){return new e({actionId:n.g.id,actionType:"hide"}).$save({},function(){var e;if(!t.initValue)return e=t.data.collections[a].games.indexOf(n),t.data.collections[a].games.splice(e,1)})},t.showGame=function(t){return t.is_view||(t.is_view=!0),a.open("/win/"+t.g.id)},t.hideCompany=function(a){return new e({actionId:a.g.id,actionType:"hideCompany"}).$save({},function(){if(!t.initValue)return n.get({},function(n){return t.data=n})})},t.hideTag=function(i){return new e({actionId:i.g.id,actionType:"hideTags",tags_id:t.tags_id}).$save({},function(){if(!t.initValue)return n.get({path:a.location.pathname},function(n){return t.data=n})})},t.openModal=function(n){return t.modalTags=n.tags},t.sendModal=function(){return new e({actionType:"hideTags",tags_id:t.tags_id}).$save({},function(){if(!t.initValue)return n.get({path:a.location.pathname},function(n){return t.data=n})})}}]).controller("TagCtrl",["$scope","APIGames","APIControl","$window",function(t,n,e,a){return t.$watch("tag_hide",function(){return console.log(t.tag_hide)})}]);
//# sourceMappingURL=app-min.js.map
