<div id="content">
  <div id="content-header">
    <!-- <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
     --><h1>菜品修改</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>菜品修改</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate  enctype="multipart/form-data" >
              <div class="control-group">
                <label class="control-label">菜名</label>
                <div class="controls">
                  <input type="text" name="name" id="name" value="<?php echo $datas['name']; ?>" >
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">类型</label>
                <div class="controls">
                  <select style="width:220px;" name="type" id="type" >
                  	  <option value="">--</option>
	                  <?php foreach ($arr_type as $key=>$val){?>
	                  <option value="<?php echo $key?>" <?php echo (($datas['type']==$key)?'selected':''); ?>><?php echo $val?></option>
	                  <?php } ?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">价格</label>
                <div class="controls">
                	 <div class="input-append">
                      <input type="text" placeholder="5.00" name="price" id="price" value="<?php  echo $datas['price'];?>" >
                      <span class="add-on">$</span>
                     </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">状态</label>
                <div class="controls">
                  <select style="width:220px;" name="status" id="status" >
                      <option value="">--</option>
	                  <option value="1" <?php echo (($datas['status']==1)?'selected':''); ?>>正常</option>
	                  <option value="-1" <?php echo (($datas['status']==-1)?'selected':''); ?>>冻结</option>
	              </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">图片</label>
                <div class="controls">
                    <input type="file" name="pictrue" id="pictrue"><br/>
                    <?php 
                    foreach ($images as $image){
                    
                    	?>
                    <span class="add-on"><img alt="" src="<?php echo $image['imgUrl'];?>" width="200px;" height="15px;"></span>
                    <?php }?>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">描述</label>
                <div class="controls">
                  <textarea  name="description" id="description" style="width:680px;height:400px;visibility:hidden;"><?php echo $datas['description'];?></textarea>
                </div>
              </div>              
              <div class="form-actions">
                <input type="submit" value="Edit" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
<script src="/resources/scripts/jquery.min.js"></script>
<script src="/resources/scripts/common.js"></script>
<script src="/resources/scripts/jquery.ui.custom.js"></script> 
<script src="/resources/scripts/bootstrap.min.js"></script> 
<script src="/resources/scripts/jquery.uniform.js"></script> 
<script src="/resources/scripts/select2.min.js"></script> 
<script src="/resources/scripts/jquery.validate.js"></script> 
<script src="/resources/scripts/matrix.js"></script> 
<script charset="utf-8" src="/resources/extension/kindeditor/kindeditor-min.js"></script>
<script charset="utf-8" src="/resources/extension/kindeditor/lang/zh_CN.js"></script>

<script>
$(document).ready(function(){
	//加载css
	common.includeFile( {type : 'css',url : '/resources/css/bootstrap.min.css'});
	common.includeFile( {type : 'css',url : '/resources/css/bootstrap-responsive.min.css'});
	common.includeFile( {type : 'css',url : '/resources/css/matrix-style.css'});
	common.includeFile( {type : 'css',url : '/resources/css/matrix-media.css'});
	common.includeFile( {type : 'css',url : '/resources/css/uniform.css'});
	common.includeFile( {type : 'css',url : '/resources/css/select2.css'});
	common.includeFile( {type : 'css',url : '/resources/css/font-awesome/css/font-awesome.css'});
	common.includeFile( {type : 'css',url : 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'});
	
})

$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	//$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			name:{
				required:true
			},
			type:{
				required:true
			},
			price:{
				required:true,
				number:true
			},
			status:{
				required:true
			},
			description:{
				required:true
			}
			/*,pictrue:{
				required:true
			}*/
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		}
	});
	
    var editor;
	KindEditor.ready(function(K) {
		editor = K.create('#description', {
			allowFileManager : true
		});
	});
});
</script>