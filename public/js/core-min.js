$(function(){return $('[data-toggle="tooltip"]').tooltip(),$(".toast").toast({delay:5e4}).toast("show"),$(".welcome").on("click","form",function(o){return $(".welcome-footer").addClass("d-none")}),$(document).ready(function(){if(window.location.hash)return $.smoothScroll({scrollTarget:window.location.hash+"",offset:-120,afterScroll:function(o){if("#register"===o.scrollTarget)return $(".welcome-footer").addClass("d-none")}})}),$("body").smoothScroll({delegateSelector:'[data-scroll="true"]',offset:-120,speed:1e3,afterScroll:function(o){if("#register"===o.scrollTarget)return $(".welcome-footer").addClass("d-none")}})});