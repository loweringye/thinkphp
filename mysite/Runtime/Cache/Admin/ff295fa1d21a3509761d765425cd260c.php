<?php if (!defined('THINK_PATH')) exit();?><extend name="Layout/extend" />

<script type="text/javascript" src="/Public/Js/upload.js"></script>
<script type="text/javascript" src="/Public/Js/jquery-form.js"></script>

<!-- Modal -->
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">文章分类<?php echo !empty($post_type['id'])?'编辑':'新增';?></h4>
    </div>
    <div class="modal-body">
      
<form class="form-horizontal" method="post" action="<?php echo U('/admin/post_type/add','','')?>" id="save-form">
  <input type="hidden" name="id" value="<?php echo $post_type['id']?>" >
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="请填写您的名称" required name="name" maxlength="32" value="<?php echo $post_type['name']?>">
    </div>
    <label for="inputEmail3" class="col-sm-2 control-label">别名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" placeholder="请填写您的英文别名" required name="url_name" maxlength="32" value="<?php echo $post_type['url_name']?>">
    </div>
    <input type="submit" style="display:none;" />
  </div>
</form>
<form class="form-horizontal hidden" id="img-add-form" data-curl="<?php echo U('/admin/upload/img','','')?>">
   <div class="col-sm-9">
   	<input type="hidden"  class="" value="1" name="image_file"/>
   	<input type="file"  id="img-add-form-file" class="pointer" name="image" />
   	<input type="hidden" name="image" />
   </div>
</form>
<div id="upload-loading" style="position: absolute;left: 0px; right: 0px;top: 0px;background: rgba(0, 0, 0, 0.5);;width: 100%;height: 100%;z-index: 9999999; display:none;">
	<div class="upload-loading">
	  <div class="upload-loading-container container1">
	    <div class="circle1"></div>
	    <div class="circle2"></div>
	    <div class="circle3"></div>
	    <div class="circle4"></div>
	  </div>
	  <div class="upload-loading-container container2">
	    <div class="circle1"></div>
	    <div class="circle2"></div>
	    <div class="circle3"></div>
	    <div class="circle4"></div>
	  </div>
	  <div class="upload-loading-container container3">
	    <div class="circle1"></div>
	    <div class="circle2"></div>
	    <div class="circle3"></div>
	    <div class="circle4"></div>
	  </div>
	</div>
</div>
<script>
$(function (){
	$("#save-btn").click(function (){
		$("#save-form input[type='submit']").click();
	});
})
</script>

    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      <button type="button" class="btn btn-primary" id="save-btn">保存</button>
    </div>
  </div>
</div>