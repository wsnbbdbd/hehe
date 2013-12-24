<div id="content">
  <div id="content-header">
    <!-- <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div> -->
    <h1>订单</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
    	<form method="get"  action="">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
              <h5>查询条件</h5>
            </div>
            <div class="widget-content">
              <div class="controls controls-row">
              	<div class="span3 m-wrap ">
                	<label class="span3 m-wrap">下单时间:</label>
                	<div class="span9 m-wrap">
	                	<input type="text" class="span6 m-wrap" name="o_s" id="order_from" value="<?php echo $arr_search['o_s'];?>" />
	                	<input type="text" class="span6 m-wrap" name="o_e" id="order_to" value="<?php echo $arr_search['o_e'];?>" />
	               </div>
                </div>
                <div class="span3 m-wrap">
                	<label class="span3 m-wrap">配送时间:</label>
                	<div class="span9 m-wrap">
						<input type="text" class="span6 m-wrap" name="d_s" id="distribe_from" value="<?php echo $arr_search['d_s'];?>" />
	                	<input type="text" class="span6 m-wrap" name="d_e" id="distribe_to" value="<?php echo $arr_search['d_e'];?>" />
	                </div>
                </div>
                <div class="span3 m-wrap ">
                	<label class="span3 m-wrap">订单总价:</label>
                	<div class="span9 m-wrap">
						<input type="text" class="span6 m-wrap" name="p_s" id="price_from"  value="<?php echo $arr_search['p_s'];?>"/>
	                	<input type="text" class="span6 m-wrap" name="p_e" id="price_to" value="<?php echo $arr_search['p_e'];?>"/>
                	</div>
                </div>
                <div class="span3 m-wrap"> </div>
              </div>
               <div class="controls controls-row">
              	<div class="span3 m-wrap">
                	<label class="span3 m-wrap">客户账号:</label>
                	<input type="text"  class="span9 m-wrap" name="ac" value="<?php echo $arr_search['ac'];?>">
                </div>
                <div class="span3 m-wrap">
                	<label class="span3 m-wrap">订单渠道:</label>
                	<select id="format" class="span9 m-wrap" name="sou">
						<option value="">--</option>
						<?php foreach($arr_source as $key=>$source){?>
						<option value="<?php echo $key;?>"><?php echo $source;?></option>
						<?php }?>
					</select>
                </div>
                <div class="span3 m-wrap">
                	<label class="span3 m-wrap">订单状态:</label>
                	<select id="format" class="span9 m-wrap" name="st">
						<option value="">--</option>
						<?php foreach($arr_status as $key=>$status){?>
						<option value="<?php echo $key;?>"><?php echo $status;?></option>
						<?php }?>
					</select>
                </div>
                <div class="span3 m-wrap"></div>
                
              </div>
              <div class="controls controls-row">
              	<div class="span3 m-wrap">
                	<label class="span3 m-wrap">订单类型:</label>
                	<select id="format" class="span9 m-wrap" name="tp">
						<option value="">--</option>
						<?php foreach($arr_type as $key=>$type){?>
						<option value="<?php echo $key;?>"><?php echo $type;?></option>
						<?php }?>
					</select>
                </div>
              	<div class="span3 m-wrap">
                	<label class="span3 m-wrap">配送人员:</label>
                	<select id="format" class="span9 m-wrap" name="dv">
						<option value="">--</option>
						<?php /*foreach($arr_source as $key=>$source){?>
						<option value="<?php echo $key;?>"><?php echo $source;?></option>
						<?php }*/?>
					</select>
                </div>
                <div class="span4 m-wrap">
                </div>
                <div class="span2 m-wrap">
                     <button class="btn btn-primary" type="submit" style="background-color:#28B779;" ><i class="icon-search icon-white"></i> 查询</button>
                </div>
              </div>
            </div>
          </div>
         </form>
    </div>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon">
            <input type="checkbox" id="title-checkbox" name="title-checkbox" />
            </span>
            <h5>订单列表</h5>
            <a class="" href="/order/default/add"><span class="label label-success">创建订单</span></a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th><i class="icon-resize-vertical"></i></th>
                  <th>订单日期</th>
                  <th>客户账号</th>
                  <th>订单来源</th>
                  <th>订单总价</th>
                  <th>菜品总量</th>
                  <th>下单时间</th>
                  <th>订单状态</th>
                  <th>操作</th>
                </tr>
              </thead>
             <tbody>
             	<?php foreach ($obj_list as $obj_info){ ?>
             		<tr class="gradeA">
	                  <td style="text-align: center;"><input type="checkbox" value="<?php echo $obj_info['id'];?>"/></td>
	                  <td style="text-align: center;"><?php echo date('Y-m-d',strtotime($obj_info['orderDate']));?></td>
	                  <td style="text-align: center;"><?php echo $obj_info['account'];?></td>
                      <td style="text-align: center;"><?php echo $arr_source[$obj_info['source']];?></td>
	                  <td style="text-align: center;">￥<?php echo sprintf('%.2f',$obj_info['totalPrice']);?></td>
	                  <td style="text-align: center;"><?php echo $obj_info['totalNumber'];?></td>
                      <td style="text-align: center;"><?php echo date('Y-m-d H:i:s',strtotime($obj_info['insertTime']));?></td>
	                  <td style="text-align: center;"><span class="in-progress"><?php
	                  $info = '';
	                  switch ($obj_info['status']){
	                  	case 1:
	                  		$info = '<span class="badge badge-info">等待配送</span>';
	                  		break;
	                  	case 2:
	                  		$info = '<span class="badge badge-warning">配送中</span>';
	                  		break;
	                  	case 3:
	                  		$info = '<span class="badge badge-success">成功</span>';
	                  		break;
	                  	case 4:
	                  		$info = '<span class="badge badge-inverse">订单异常</span>';
	                  		break;
	                  	case 5:
	                  		$info = '<span class="badge badge-danger">取消</span>';
	                  		break;
	                  }
	                  echo $info;
	                  ?></span></td>
	                  <td style="text-align: center;">
	                   
	                  <a class="tip" href="/order/default/detail?id=<?php echo $obj_info['id'];?>" title="详情"><i class="icon-info-sign"></i></a>&nbsp;
                      
                       <a class="tip" href="/order/default/edit?id=<?php echo $obj_info['id'];?>" title="修改订单"><i class="icon-pencil"></i></a>&nbsp;
	                  <?php if ($obj_info['status']<3){?>	                  
	                  <a class="tip" href="/order/default/cancel?id=<?php echo $obj_info['id'];?>" title="取消"><i class="icon-remove"></i></a>&nbsp;
                      
                      <a class="tip" href="/order/default/faild?id=<?php echo $obj_info['id'];?>" title="异常"><i class="icon-warning-sign"></i></a>&nbsp;
					<?php }?>
					<!-- <a href="#" class="tip-top" data-original-title="Update"><i class="icon-ok"></i></a>
					<a href="#" class="tip-top" data-original-title="Delete"><i class="icon-remove"></i></a>-->
					<!--<div class="fr"><a class="btn btn-primary btn-mini" href="#">Edit</a>
					<a class="btn btn-success btn-mini" href="#">Publish</a>
					<a class="btn btn-danger btn-mini" href="#">Delete</a>
					</div>--></td>
                </tr>
             	<?php }?>
              </tbody>
            </table>
          </div>
          <div class="widget-content nopadding ">
          	<?php $this->widget('Pagination', array('arr_page_param' => $arr_page_param)); ?>
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
<script src="/resources/scripts/matrix.js"></script> 
<script src="/resources/scripts/jqueryui/jquery.ui.core.js"></script>
<script src="/resources/scripts/jqueryui/jquery.ui.widget.js"></script>
<script src="/resources/scripts/jqueryui/jquery.ui.datepicker.js"></script>
<script>
$(document).ready(function(){
	//加载css
	
	common.includeFile( {type : 'css',url : '/resources/scripts/jqueryui/themes/base/jquery.ui.all.css'});
	common.includeFile( {type : 'css',url : '/resources/css/bootstrap.min.css'});
	common.includeFile( {type : 'css',url : '/resources/css/bootstrap-responsive.min.css'});
	common.includeFile( {type : 'css',url : '/resources/css/matrix-style.css'});
	common.includeFile( {type : 'css',url : '/resources/css/matrix-media.css'});
	common.includeFile( {type : 'css',url : '/resources/css/uniform.css'});
	common.includeFile( {type : 'css',url : '/resources/css/select2.css'});
	common.includeFile( {type : 'css',url : '/resources/css/font-awesome/css/font-awesome.css'});
	common.includeFile( {type : 'css',url : 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'});
	$("#order_from" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 2,
		dateFormat:'yy-mm-dd',
		onClose: function( selectedDate ) {
			$("#order_to").datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#order_to" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths:2,
		dateFormat:'yy-mm-dd',
		onClose: function( selectedDate ) {
			$( "#order_from" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	$("#distribe_from" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 2,
		dateFormat:'yy-mm-dd',
		onClose: function( selectedDate ) {
			$("#distribe_to").datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#distribe_to" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths:2,
		dateFormat:'yy-mm-dd',
		onClose: function( selectedDate ) {
			$( "#distribe_from" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	$('input[type=checkbox],input[type=radio],input[type=file]').uniform();
	
	$("span.icon input:checkbox, th input:checkbox").click(function() {
		var checkedStatus = this.checked;
		var checkbox = $(this).parents('.widget-box').find('tr td:first-child input:checkbox');		
		checkbox.each(function() {
			this.checked = checkedStatus;
			if (checkedStatus == this.checked) {
				$(this).closest('.checker > span').removeClass('checked');
			}
			if (this.checked) {
				$(this).closest('.checker > span').addClass('checked');
			}
		});
	});	
})
</script>

