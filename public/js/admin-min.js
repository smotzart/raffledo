$(function(){return $('[data-toggle="tooltip"]').tooltip(),$("#removeTag").on("show.bs.modal",function(t){var e,n,a,l;return a=(e=$(t.relatedTarget)).data("tagid"),l=e.data("tagname"),(n=$(this)).find("#modal-tag-name").text(l),n.find("#tagId").val(a)}),$("#price_info").on("change",function(t){return $(this).is(":checked")?$("#price").attr({rows:5,placeholder:"Information "}):$("#price").attr({rows:1,placeholder:"Preis"})}),$("#companies_id").on("change",function(){return"new"===$(this).val()?$("#new_game").removeClass("d-none").find("input").removeAttr("disabled"):$("#new_game").addClass("d-none").find("input").attr("disabled","disabled")}),$("#url_change .form-control").on("change",function(t){return $.get("/admin/games/search",{search:$(this).val()},function(t){var e,n,a,l;if(console.log(t.length),t.length>0){for(n='<ul class="list-group list-group-flush">',e=0,l=t.length;e<l;e++)n+='<li class="list-group-item"><h5>'+(a=t[e]).title+"</h5><small>"+a.url+"</small></li>";return n+="</ul>",$("#existUrl .modal-body").html(n),$("#existUrl").modal("show")}},"json")})});
//# sourceMappingURL=admin-min.js.map
