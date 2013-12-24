<div id="content">
  <div id="content-header">
   <!-- <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>-->
    <h1>编辑客户</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >用户基本信息</h5>
          </div>
          <div class="widget-content">
            <div class="row-fluid">
              <div class="span6">
              <form class="form-horizontal" method="post" action="#" name="basic_validate" id="basic_validate" novalidate   >
               <div class="control-group">
              	<table class="">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">账号:</td>
                      <td class="width70"><strong><?php echo $datas['account'];?></strong>
                      	<input type="hidden" name="id" id="id" value="<?php echo $datas['id'];?>">
                      </td>
                    </tr>
                    <tr>
	                   <td class="width30">积分:</td>
	                   <td class="width70"><strong><?php echo sprintf('%.2f',$datas['integral']);?></strong> 
	                   </td>
	                 </tr>
                    <tr>
	                   <td class="width30">姓名:</td>
	                   <td class="width70"><strong><input type="text" name="name" id="name" value="<?php echo $datas['name'];?>"></strong> 
	                   </td>
	                 </tr>
	                 <tr>
	                   <td class="width30">生日:</td>
	                   <td class="width70"><strong><input type="text" name="birthday" id="birthday" value="<?php echo $datas['birthday'];?>"></strong> 
	                   </td>
	                 </tr>
	                 <tr>
	                   <td class="width30">QQ:</td>
	                   <td class="width70"><strong><input type="text" name="QQ" id="QQ" value="<?php echo $datas['QQ'];?>"></strong> 
	                   </td>
	                 </tr>
	                 <tr>
	                   <td class="width30">微博号:</td>
	                   <td class="width70"><strong><input type="text" name="weiboAccount" id="weiboAccount" value="<?php echo $datas['weiboAccount'];?>"></strong> 
	                   </td>
	                 </tr>
	                 <tr>
	                   <td class="width30">状态:</td>
	                   <td class="width70">
	                   <select style="width:220px;" name="status" id="status" >
		                  <option value="1">正常</option>
		                  <option value="-1" <?php echo ($datas['status']==0)?'selected':'';?>>冻结</option>
	                  </select>
	                 
	                   </td>
	                 </tr>
	                 <tr>
                      <td>注册时间:</td>
                      <td><strong><?php echo $datas['insertTime'];?></strong></td>
                    </tr>
                    <tr>
                      <td>最后一次登录时间:</td>
                      <td><strong><?php echo $datas['lastLoginTime'];?></strong></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td>
	                     
		              </td>
                    </tr>
                  </tbody>
                </table>
                </div>
                 <div class="form-actions">
	                <input type="submit" value="编辑" class="btn btn-success">
	              </div>
                </form>
              </div>
              <div class="span6">
                <table class="">
                  <tbody>
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td ></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
              <div class="widget-title"> <span class="icon"> <i class="icon-time"></i> </span>
	            <h5 >用户收货地址</h5>
	          </div>
              <div class="widget-content nopadding">
	            <table class="table table-striped table-bordered">
	              <tbody>
	              <?php 
	              foreach($address as $info){
	              ?>
					<tr><td class="taskDesc"><i class="icon-info-sign"></i><?php echo $address_type[$info['type']].'  '.$info['sArea'].'  '.$info['sCommunity'].'  '.$info['address'];?></td></tr>
	              <?php 
	              }
	              ?>
	              </tbody>
	            </table>
	          </div>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
              <div class="widget-title"> <span class="icon"> <i class="icon-time"></i> </span>
	            <h5 >用户操作记录</h5>
	          </div>
              <div class="widget-content nopadding">
	            <table class="table table-striped table-bordered">
	              <tbody>
	              <?php 
	              foreach($userlog as $obj_log){
	              ?>
	              <tr><td class="taskDesc"><i class="icon-info-sign"></i><?php echo '用户：'.$obj_log['account'].'  '.$obj_log['operation'].'  '.$obj_log['insertTime'].'  '.$obj_log['remark'];?></td></tr>
	              <?php 
	              }
	              ?>
	              </tbody>
	            </table>
	          </div>
                <div class="widget-content nopadding ">
		          	<?php //$this->widget('Pagination', array('arr_page_param' => $arr_page_param)); ?>
		        </div>
              </div>
            </div>
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