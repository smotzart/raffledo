$(function(){var e;return $('[data-toggle="tooltip"]').tooltip(),$("#removeTag").on("show.bs.modal",function(e){var a,n,t,i;return t=(a=$(e.relatedTarget)).data("tagid"),i=a.data("tagname"),(n=$(this)).find("#modal-tag-name").text(i),n.find("#tagId").val(t)}),$("#price_info").on("change",function(e){return $("#price").attr({placeholder:$(this).is(":checked")?"Information":"Preis"})}),$("[data-tag='yes']").tagsinput({tagClass:"badge badge-info",cancelConfirmKeysOnEmpty:!1}),$("#companies_id").on("change",function(){return"new"===$(this).val()?$("#new_game").removeClass("d-none").find("input").removeAttr("disabled"):$("#new_game").addClass("d-none").find("input").attr("disabled","disabled")}),$("#companies_id").change(),$("#url_change .form-control").on("change",function(e){return $.get("/admin/companies/search",{search:$(this).val()},function(e){var a,n,t,i,o;if(e.length>0){for(n=$('<div class="list-group list-group-flush"></div>'),a=0,o=e.length;a<o;a++)i=e[a],(t=$('<a href="#" data-company="'+i.id+'" class="list-group-item list-group-item-action">'+i.name+"</a>")).on("click",function(e){var a;return e.preventDefault(),a=$(this).data("company"),$("#companies_id").val(a).change(),$("#existUrl").modal("hide")}),n.append(t);return $("#existUrl .modal-body").html(n),$("#existUrl").modal("show")}},"json")}),(e=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.obj.whitespace("name"),queryTokenizer:Bloodhound.tokenizers.whitespace,prefetch:{url:"/admin/tags/get",cache:!1,filter:function(e){return $.map(e,function(e){return{name:e.name}})}}})).initialize(),$("#tags_input").tagsinput({tagClass:"badge badge-info",cancelConfirmKeysOnEmpty:!1,trimValue:!0,typeaheadjs:{name:"tagsname",displayKey:"name",valueKey:"name",source:e.ttAdapter()}})});
//# sourceMappingURL=admin-min.js.map
