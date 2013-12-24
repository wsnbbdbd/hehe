<div id="content">
  <div id="content-header">
    <!-- div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Addons pages</a> <a href="#" class="current">invoice</a> </div> -->
    <h1>订单</h1>
  </div>
  <form action="" method="post"/>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-briefcase"></i> </span>
            <h5 >订单详情</h5>
          </div>
          <div class="widget-content">
         <?php if ($obj_loglist){ ?>
          	  <div class="span12">
		        <div class="widget-box">
		          <div class="widget-title"> <span class="icon"><i class="icon-time"></i></span>
		            <h5>操作日志</h5>
		          </div>
		          <div class="widget-content nopadding">
		            <table class="table table-striped table-bordered">
		              <tbody>
		              <?php 
		              foreach($obj_loglist as $obj_log){
		              ?>
		              <tr><td class="taskDesc"><i class="icon-info-sign"></i><?php echo '操作人：'.$obj_log['operator'].'  '.$obj_log['insertTime'].'  '.$obj_log['remark'];?></td></tr>
		              <?php 
		              }
		              ?>
		              </tbody>
		            </table>
		          </div>
		        </div>
		      </div>
           <?php  } ?>
            <div class="row-fluid">
              <div class="span6">
                <table class=""  >
                  <tbody>
                    <tr><!-- pending done -->
                      <td class="taskStatus"  >
                      <?php $info = '';
	                  switch ($arr_order['status']){
	                  	case 5:
	                  		$info = '<span class="pending" style="text-align:left;color:#FF0000"><h4>订单取消</h4></span>';
	                  		break;
	                  	case 1:
	                  		$info = '<span class="in-progress" style="text-align:left;"><h4>等待配送</h4></span>';
	                  		break;
	                  	case 2:
	                  		$info = '<span class="pending" style="text-align:left;"><h4>配送中</h4></span>';
	                  		break;
	                  	case 3:
	                  		$info = '<span class="done" style="text-align:left;"><h4>配送成功</h4></span>';
	                  		break;
	                  	case 4:
	                  		$info = '<span class="pending" style="text-align:left;color:#aaaaaa"><h4>订单异常</h4></span>';
	                  		break;
	                  }
	                  echo $info;
	                  ?>
                      
                      
                      </td>
                    </tr>
                    <tr>
                      <td>下单时间</td>
                    </tr>
                    <tr>
                      <td><?php echo date("Y-m-d H:i:s",strtotime($arr_order['insertTime'])); ?></td>
                    </tr>
                    <tr>
                      <td>配送时间</td>
                    </tr>
                    <tr>
                      <td ><?php if($arr_order['deliveryTime']){echo date("Y-m-d H:i:s",strtotime($arr_order['deliveryTime']));} ?></td>
                    </tr>
                    <tr>
                      <td>完成时间</td>
                    </tr>
                    <tr>
                      <td ><?php 
                      if($arr_order['successTime']){ echo date("Y-m-d H:i:s",strtotime($arr_order['successTime']));} ?></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="span6">
                <table class="table table-bordered table-invoice">
                  <tbody>
                    <tr>
                    <tr>
                      <td class="width30">用户账号:</td>
                      <td class="width70"><strong><?php echo $arr_order['account']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>收货人姓名:</td>
                      <td><strong><?php echo $arr_order['name']; ?></strong></td>
                    </tr>
                    <tr>
                      <td>电话:</td>
                      <td><strong><?php echo $arr_order['mobile']; ?></strong></td>
                    </tr>
                  <td class="width30">地址:</td>
                    <td class="width70"><!-- <strong>Cliente Company name.</strong>  <br>-->
                    <?php echo $arr_order['address']; ?>
                     </td>
                  </tr>
                    </tbody>
                  
                </table>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
                <table class="table table-bordered table-invoice-full">
                  <thead>
                    <tr>
                      <th class="head0">编号</th>
                      <th class="head1">菜名</th>
                      <th class="head0 right">价格</th>
                      <th class="head1 right">数量</th>
                      <th class="head0 right">小计</th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php
                  	$total_price = 0;
					if (!empty($obj_order_dishs)){
                      	foreach($obj_order_dishs as $arr_dish){
                      	$total_price += sprintf('%.2f',(sprintf('%.2f',$arr_dish['price'])*$arr_dish['quantity']));
                      	?>
                        <tr>
                        <td class="right"><?php echo $arr_dish['dishId']?><input type="hidden" name="ids[]" value="<?php echo $arr_dish['dishId']?>"></td>
                        <td class="right"><?php echo $arr_dish['dishName']?><input type="hidden"  name="name[]"  value="<?php echo $arr_dish['dishName']?>"></td>
                        <td class="right">￥<?php echo sprintf('%.2f',$arr_dish['price']);?><input type="hidden"  name="price[]"  value="<?php echo $arr_dish['price']?>"></td>
                        <td class="right"><?php echo $arr_dish['quantity']?></td>
                        <td class="right">￥<?php echo sprintf('%.2f',(sprintf('%.2f',$arr_dish['price'])*$arr_dish['quantity']));?></td>
                        </tr>
                        <?php }}?>
                  </tbody>
                </table>
                <?php if ($arr_order['status']==0){?>
                <div class="control-group"  id="selected_dish">
              	<div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>配送员</h5>
                  </div>
                  <div class="widget-content">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th></th>
                          <th>姓名</th>
                          <th>目前订单</th>
                        </tr>
                      </thead>
                      <tbody id="dish_list">
                      	<?php
                      	//print_r($arr_distributors);
						if (!empty($arr_distributors)){
                      		foreach($arr_distributors as $arr_distributor){?>
                        <tr class="odd">
                        	<td class="center"><div class="controls"><input type="radio" name="distributorId" value="<?php echo $arr_distributor['id']?>"></div></td>
                        	<td class="center"><?php echo $arr_distributor['name']?></td>
                        	<td class="center"><?php echo $arr_distributor['orderNumber']?></td>
                        </tr>
                        <?php }}?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <?php }?>
                <!--<table class="table table-bordered table-invoice-full">
                  <tbody>
                    <tr>
                      <td class="msg-invoice" width="85%"> <h4>Payment method: </h4>
                        <a href="#" class="tip-bottom" title="Wire Transfer">Wire transfer</a> |  <a href="#" class="tip-bottom" title="Bank account">Bank account #</a> |  <a href="#" class="tip-bottom" title="SWIFT code">SWIFT code </a>|  <a href="#" class="tip-bottom" title="IBAN Billing address">IBAN Billing address </a>
                      </td>
                      <td class="right"><strong>Subtotal</strong>  <br>
                        <strong>Tax (5%)</strong> <br>
                        <strong>Discount</strong> </td>
                      <td class="right"><strong> <br>
                         $600 <br>
                        $50 </strong></td>
                    </tr>
                  </tbody>
                </table>-->
                
                <div class="pull-right">
                  <h4><span>总  计:</span> ￥<?php echo sprintf('%.2f',$total_price);?></h4>
                  <?php if ($arr_order['status']==0){?>
                  <br>
                  <button class="btn btn-primary btn-large pull-right" >确定配送</button> 
				  <?php }else if ($arr_order['status']==1){?>
                  <a class="btn btn-primary btn-large pull-right" href="/order/default/success?id=<?php echo $arr_order['id']; ?>">发货成功</a> 
                  <?php }?>
               </div>  
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
<script src="/resources/scripts/masked.js"></script> 
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
	
	$('input[type=checkbox]').uniform();
	
	//$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
			menu_date:{
				required:true,
				date:true
			},
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
			shtml += '<td class="center">'+address[i].name+'</td>';
			shtml += '<td class="center">'+address[i].mobile+'</td>';
			shtml += '<td class="center">'+address[i].address+'</td>';
		}
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
