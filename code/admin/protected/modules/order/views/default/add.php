<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>创建订单</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>订单信息</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" novalidate>
              <div class="control-group">
                <label class="control-label">来源</label>
                <div class="controls">
                  <select style="width:220px;" name="source" id="source" >
                  	  <?php foreach($arr_source as $key=>$source){?>
	                  <option value="<?php echo $key;?>"><?php echo $source;?></option>
	                  <?php }?>
                  </select>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">日期</label>
                <div class="controls">
                  <div class="input-append date datepicker" date-format="yyyy-mm-dd" data-date="<?php echo date("Y-m-d"); ?>"   >
                  	<span  class="add-on"><?php echo date("Y-m-d"); ?></span>
					<input class="span11" type="hidden" date-format="yyyy-mm-dd" name="order_date" id="order_date" value="<?php echo date("Y-m-d"); ?>">
					<!--<span class="add-on"><i class="icon-th"></i></span>-->
				  </div>
                </div>
              </div>
              
               <div class="control-group">
                <label class="control-label">选择用户</label>
                <div class="controls">
                	<input  type="text"  name="account" id="account" value="">
                	<span class="add-on"><button class="btn btn-info"  data-toggle="modal"   type="button" id="select_user"><i class=" icon-search"></i>get user</button></span>
                </div>
              </div> 
              
              
              <div class="control-group" id="user_info" style="display:none;">
              	<div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>当前用户</h5>
                  </div>
                  <div class="widget-content">
	                 <table class="">
	                  <tbody>
	                    <tr>
		                   <td class="width30">手机号:</td>
		                   <td class="width70">
		                   <input type="hidden" name="nouser" id="nouser" value="">
		                   <input type="text" name="mobile" id="mobile" value="">
		                   </td>
		                 </tr>
	                    <tr>
		                   <td class="width30">客户姓名:</td>
		                   <td class="width70">
		                   <input type="text" name="name" id="name" value="">
		                   </td>
		                 </tr>
		                </tbody>
		                <tbody id="no_user" style="display:none;">
		                 <tr>
		                   <td class="width30">性别:</td>
		                   <td class="width70">
		                   <select style="width:220px;" name="status" id="status" >
			                  <option value="1">男</option>
			                  <option value="2" >女</option>
		                  </select>
		                   </td>
		                 </tr>
		              
		                 <tr>
		                   <td class="width30">地址类型:</td>
		                   <td class="width70">
		                   <select style="width:220px;" name="status" id="status" >
			                  <option value="1">公司</option>
			                  <option value="2" >家里</option>
		                  </select>
		                   </td>
		                 </tr>
		                 <tr>
		                   <td class="width30">具体地址:</td>
		                   <td class="width70">
		                   	<select style="width:220px;" name="area" id="area" >
			                  <option value="1">天府软件园</option>
			                  <!-- <option value="2" >大源社区</option> -->
		                  </select>
		                  <select style="width:220px;" name="community" id="community" >
			                  <option value="3">E1</option>
			                  <option value="4" >E2</option>
			                  <option value="5" >E3</option>
		                  </select>
		                  <input type="text" name="company" id="company" value="">
		                   </td>
		                 </tr>
		                 
		                 <tr>
		                   <td class="width30">公司名称:</td>
		                   <td class="width70">
		                   	<input type="text" name="company" id="company" value="">
		                   </td>
		                 </tr>
		                 </div>
	                  </tbody>
	                </table>
	                
		            <div id="current_user" style="display:none;">
		                <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
	                     <h5>当前用户地址</h5>
		                 </div>
		                    <table class="table table-bordered table-striped">
		                      <thead>
		                        <tr>
		                          <th></th>
		                          <th>类型</th>
		                          <th>大区</th>
		                          <th>小区</th>
		                          <th>地址</th>
		                        </tr>
		                      </thead>
		                      <tbody id="address_list">
		                      	
		                      </tbody>
		                    </table>
	                  </div>
                  </div>
                  
                </div>
              </div> 
              
              
             
              
              <div class="control-group"  id="selected_dish">
              	<div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>当前菜品</h5>
                  </div>
                  <div class="widget-content">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>编号</th>
                          <th>名称</th>
                          <th>价格</th>
                          <th>已销售/库存</th>
                          <th>订购数量</th>
                        </tr>
                      </thead>
                      <tbody id="dish_list">
                      	<?php
						if (!empty($obj_dish_list)){
                      		foreach($obj_dish_list as $arr_dish){?>
                        <tr class="odd">
                        	<td class="center"><?php echo $arr_dish['dishId']?><input type="hidden" name="ids[]" value="<?php echo $arr_dish['dishId']?>"></td>
                        	<td class="center"><?php echo $arr_dish['dishName']?><input type="hidden"  name="name[]"  value="<?php echo $arr_dish['dishName']?>"></td>
                        	<td class="center"><?php echo $arr_dish['price']?><input type="hidden"  name="price[]"  value="<?php echo $arr_dish['price']?>"></td>
                        	<td class="center"><?php echo $arr_dish['sold']?>/<?php echo $arr_dish['stock']?></td>
                        	<td class="center"><input type="text" value="" name="order_number[]"  stype="order_number" data-price="<?php echo $arr_dish['price']?>" ></td>
                        </tr>
                        <?php }}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
              <div class="control-group">
                <label class="control-label">小计：</label>
                <div class="controls">
                	<span class="add-on" id="subtotal_txt"></span>
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">备注：</label>
                <div class="controls">
                  <textarea id="remark" name="remark"></textarea>
                </div>
              </div> 
              <div class="form-actions">
                <input type="submit" value="确认下单" class="btn btn-success">
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

<script src="/resources/scripts/bootstrap-datepicker.js"></script> 

<script>
$(document).ready(function(){
	//加载css
	common.includeFile( {type : 'css',url : '/resources/css/bootstrap.min.css'});
	common.includeFile( {type : 'css',url : '/resources/css/bootstrap-responsive.min.css'});
	common.includeFile( {type : 'css',url : '/resources/css/matrix-style.css'});
	common.includeFile( {type : 'css',url : '/resources/css/matrix-media.css'});
	common.includeFile( {type : 'css',url : '/resources/css/uniform.css'});
	common.includeFile( {type : 'css',url : '/resources/css/select2.css'});
	common.includeFile( {type : 'css',url : '/resources/css/datepicker.css'});
	common.includeFile( {type : 'css',url : '/resources/css/font-awesome/css/font-awesome.css'});
	common.includeFile( {type : 'css',url : 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'});
	
})

$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio]').uniform();
	
	//$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			menu_date:{
				required:true,
				date:true
			},
			source:{
				required:true
			}
			/*status:{
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
	//$('.datepicker').datepicker();
	
	$('#select_user').bind('click',function(){
		getuser({});
	})
	Subtotal();
});

function getuser(){
	var account = $('#account').val();
	if (account==''){
		alert('user not null！');
		return false;
	}
	$.ajax({
		type: "POST",
		url: "/user/user/ajax",
		data: ({action:'getuserinfo',account:account}),
		dataType: "json",
		global:false,
		timeout:15000,
		success: function(data){
			filladdress(data);
		},beforeSend:function(){},
		error:function(s,error){}
	});
}


function filladdress(data){
	var shtml = '';
	$('#mobile').val($('#account').val());
	
	$('#user_info').show();
	if (data.address.length>0){
		var address = data.address;
		var address_length = data.address.length;
		for (i=0;i<address_length;i++)
		{
			if (address[i].isDefault==1){
				shtml += '<tr class="odd"><td class="center"><input type="radio"  name="address_id"  value="'+address[i].id+'" checked></td>';
			}else{
				shtml += '<tr class="odd"><td class="center"><input type="radio"  name="address_id"  value="'+address[i].id+'" ></td>';
			}
			shtml += '<td class="center">'+data.type[address[i].type]+'</td>';
			shtml += '<td class="center">'+address[i].sArea+'</td>';
			shtml += '<td class="center">'+address[i].sCommunity+'</td>';
			shtml += '<td class="center">'+address[i].address+'</td></tr>';
		}
		$("#no_user").hide();
		$("#current_user").show();
		$('#nouser').val('');
		$('#name').val(data.user.name);
	}else{
		$("#current_user").hide();
		$("#no_user").show();
		$('#nouser').val(1);
		$('#name').val('');
	}
	$('#address_list').html(shtml);
}

function Subtotal(){
	
	$("input[stype='order_number']").blur(function(){
		var total = 0;
		var total_price=0;
		$("input[stype='order_number']").each(function(){
			if ($(this).val()!=''){
				total = total+parseInt($(this).val());
				total_price = total_price+(parseInt($(this).val())*parseInt($(this).attr('data-price')));
			}
		})
		$('#subtotal_txt').html('共含：'+total+' 件菜品，花费 '+total_price+' 元');
	});
}


</script>

<style>
/*.select_li{background-color:#999999;};
.select_li a:link, .select_li a:visited {color: #666666; text-decoration:none;}
.select_li a:hover {color: #666666; background-color:#999999;}
*/
.center_button{text-align:center; margin:10 10 10 5; line-height:40px;}
li.select_li {
    background-color: #27a9e3; border-bottom: 1px solid #2799e3;  border-top: 1px solid #27a9e3;
}
li.select_li a{ color:#fff; text-decoration:none;}
li.select_li a:hover{ color: #fff; background-color: #27a9e3;}
</style>