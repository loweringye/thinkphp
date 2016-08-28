/**
 * Created by ye on 2016/6/19.
 */
function pre_submit_file(objfile){
    var file = objfile.files[0];
    if(!/\.(gif|jpg|jpeg|png|GIF|JPG|PNG)$/.test(file.name)){
    	alert('这里只能上传图片哦');
        return false;
    }
    var reader = new FileReader();
    reader.readAsDataURL(file);
    if(file.size>4*1024*1024){
    	alert('这里只允许上传4M及以下的图片哦');
    	return false;
    }
    $("#upload-loading").show();
    return true;
}
$(function(){
	$('.open-dialog').click(function(){
		var href = $(this).attr('href');
		var dialog = '';
		if($('#addFormModal').is('div')){
			$('#addFormModal').remove();
		}
		dialog = $('<div class="modal fade" id="addFormModal" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true"></div>');
		dialog.load(href).modal({
			show:true
		});
	});
});
