$(function(){return $('[data-toggle="tooltip"]').tooltip(),$("#removeTag").on("show.bs.modal",function(a){var t,e,n,i;return n=(t=$(a.relatedTarget)).data("tagid"),i=t.data("tagname"),(e=$(this)).find("#modal-tag-name").text(i),e.find("#tagId").val(n)}),$("#price_info").on("change",function(a){return $(this).is(":checked")?$("#price").attr({rows:5,placeholder:"Information "}):$("#price").attr({rows:1,placeholder:"Preis"})}),$("[data-tag='yes']").tagsinput({tagClass:"badge badge-info",cancelConfirmKeysOnEmpty:!1}),$("#companies_id").on("change",function(){return"new"===$(this).val()?$("#new_game").removeClass("d-none").find("input").removeAttr("disabled"):$("#new_game").addClass("d-none").find("input").attr("disabled","disabled")}),$("#url_change .form-control").on("change",function(a){return $.get("/admin/companies/search",{search:$(this).val()},function(t){var e,n,i,o,r;if(t.length>0){for(n=$('<div class="list-group list-group-flush"></div>'),e=0,r=t.length;e<r;e++)o=t[e],(i=$('<a href="#" data-company="'+o.id+'" class="list-group-item list-group-item-action">'+o.name+"</a>")).on("click",function(t){var e;return a.preventDefault(),e=$(this).data("company"),$("#companies_id").val(e).change(),$("#existUrl").modal("hide")}),n.append(i);return $("#existUrl .modal-body").html(n),$("#existUrl").modal("show")}},"json")})});
//# sourceMappingURL=admin-min.js.map
