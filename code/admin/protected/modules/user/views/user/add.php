<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>添加</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>添加用户d</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate  enctype="multipart/form-data" >
              <div class="control-group">
                <label class="control-label">姓名</label>
                <div class="controls">
                  <input type="text" name="name" id="name">
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">类型</label>
                <div class="controls">
                  <select style="width:220px;" name="type" id="type" >
                  	  <option value="">--</option>
	                  <option value="1">1</option>
	                  <option value="2">2</option>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">price</label>
                <div class="controls">
                	 <div class="input-append">
                      <input type="text" placeholder="5.00" name="price" id="price">
                      <span class="add-on">$</span>
                     </div>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                  <select style="width:220px;" name="status" id="status" >
                      <option value="">--</option>
	                  <option value="1">on</option>
	                  <option value="-1">off</option>
	              </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">description</label>
                <div class="controls">
                  <textarea  name="description" id="description"></textarea>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">picture</label>
                <div class="controls">
                    <input type="file" name="pictrue" id="pictrue">
                </div>
              </div>
              
              <div class="form-actions">
                <input type="submit" value="Add" class="btn btn-success">
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
	
});
</script>