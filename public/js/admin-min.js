$(function(){var e;return $('[data-toggle="tooltip"]').tooltip(),$("#removeTag").on("show.bs.modal",function(e){var a,n,t,i;return t=(a=$(e.relatedTarget)).data("tagid"),i=a.data("tagname"),(n=$(this)).find("#modal-tag-name").text(i),n.find("#tagId").val(t)}),$("#price_info").on("change",function(e){return $("#price").attr({placeholder:$(this).is(":checked")?"Information":"Preis"})}),$("[data-tag='yes']").tagsinput({tagClass:"badge badge-info",cancelConfirmKeysOnEmpty:!1}),$("#companies_id").on("change",function(){return"new"===$(this).val()?$("#new_game").removeClass("d-none").find("input").removeAttr("disabled"):$("#new_game").addClass("d-none").find("input").attr("disabled","disabled")}),$("#companies_id").change(),$("#url_change .form-control").on("change",function(e){var a;return a=$(this),$.get("/admin/companies/search",{search:a.val()},function(e){var n,t,i;if(1===e.length)for(n=0,i=e.length;n<i;n++)t=e[n],$("#companies_id").val(t.id).change();return $.get("/admin/games/search",{search:a.val()},function(e){return e.length>0?a.addClass("is-invalid text-danger"):a.removeClass("is-invalid text-danger")},"json")},"json")}),(e=new Bloodhound({datumTokenizer:Bloodhound.tokenizers.obj.whitespace("name"),queryTokenizer:Bloodhound.tokenizers.whitespace,prefetch:{url:"/admin/tags/get",cache:!1,filter:function(e){return $.map(e,function(e){return{name:e.name}})}}})).initialize(),$("#tags_input").tagsinput({tagClass:"badge badge-info",cancelConfirmKeysOnEmpty:!1,trimValue:!0,typeaheadjs:{name:"tagsname",displayKey:"name",valueKey:"name",source:e.ttAdapter()}})});