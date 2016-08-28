/**
 * Created by ye on 2016/6/19.
 */
$(function (){
	var obj ;
	$("body").on('click','.img-add',function (){
		obj=$(this);
		$("#img-add-form-file").click();
	})
	$("#img-add-form-file").change(function (){
		if(pre_submit_file($(this)[0])){
			var path = obj.parent().attr('data-path');
			var flag = obj.parent().attr('data-flag');
			var s = obj.parent().attr('data-s');
			var h = obj.parent().attr('data-upload-height');
			var w = obj.parent().attr('data-upload-width');
			$("#img-add-form").ajaxSubmit({
				 type: 'post', 
				 url: $("#img-add-form").attr('data-curl'),
				 data:{path:path,flag:flag,height:h,width:w,single:s},
			     success: function(data){
			    	if(obj.parent().attr('data-save-url')){
				    	$.post(obj.parent().attr('data-save-url'),{key:obj.parent().attr('data-type'),value:data.url})
			    	}
			    	if(obj.parent().attr('data-input-name')){
			    		obj.parent().append('<input type="hidden" name="'+obj.parent().attr('data-input-name')+'" value="'+data.url+'"/>');
			    	}
			        var html = '<img class="img-add" src="'+data.url+'" height="'+obj.parent().attr('data-height')+'" width="'+obj.parent().attr('data-width')+'" />';
			        obj.replaceWith(html);;
			        $("#upload-loading").hide();
		        	$(this).val('');
			     }
			});
		}else{
			$(this).val('');
		}
	});
})