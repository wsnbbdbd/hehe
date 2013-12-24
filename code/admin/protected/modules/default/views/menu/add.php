<div id="content">
  <div id="content-header">
    <!-- <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>-->
    <h1>添加菜单</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>添加菜单</h5>
          </div>
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="" name="basic_validate" id="basic_validate" >
              <div class="control-group">
                <label class="control-label">日期</label>
                <div class="controls  controls-row">
                	<div class="span2 m-wrap">
	                	 <input type="text" class="span12 m-wrap" name="date_from" id="date_from" value="" />
	               </div>
                	<div class="span2 m-wrap">
						 <input type="text" class="span12 m-wrap" name="date_to" id="date_to" value="" />
	                </div>
                    <div class="span6 m-wrap">
	                </div>
                 
                </div>
              </div>
              
              <!--<div class="control-group">
                <label class="control-label">Status</label>
                <div class="controls">
                  <select style="width:220px;" name="status" id="status" >
                      <option value="">--</option>
	                  <option value="1">on</option>
	                  <option value="-1">off</option>
	              </select>
                </div>
              </div>-->
              <div class="control-group">
                <label class="control-label">选择菜品</label>
                <div class="controls">
                	<button class="btn btn-info"  data-toggle="modal"   type="button" id="dish_select"><i class="icon-plus"></i>选择菜品</button>
                </div>
              </div>
              
              <div class="control-group" style="display:none;" id="selected_dish">
              	<div class="widget-box">
                  <div class="widget-title"> <span class="icon"> <i class="icon-th"></i> </span>
                    <h5>选择菜品</h5>
                  </div>
                  <div class="widget-content">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>编号</th>
                          <th>菜品名称</th>
                          <th>价格</th>
                          <th>库存</th>
                          <th>操作</th>
                        </tr>
                      </thead>
                      <tbody id="dish_list">
                       
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>     
              <div class="form-actions">
                <input type="submit" value="确认添加" class="btn btn-success">
              </div>
            </form>
            
            <div id="myModal" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>选择菜品</h3>
              </div>
              <div class="modal-body">
                <div style=" width:200px;float:left; height:300px; overflow-y:auto; border:solid 1px #999999; overflow-x:hidden">
                <ul class="activity-list" id="dish_left">
                  
                </ul> 
                </div>
                <div class="center_select" style="width:120px;height:300px; float:left; text-align:center; vertical-align:middle;">
                	<div style="vertical-align:middle; padding-top:50px;">
                        <div class="center_button"><button class="btn btn-inverse btn-mini" id="mover_all"><i class="icon-fast-forward"></i></button></div>
                        <div class="center_button"><button class="btn btn-inverse btn-mini" id="mvoer"><i class="icon-forward"></i></button></div>
                        <div class="center_button"><button class="btn btn-inverse btn-mini" id="mvoel"><i class="icon-backward"></i></button></div>
                        <div class="center_button"><button class="btn btn-inverse btn-mini" id="mvoel_all"><i class="icon-fast-backward"></i></button></div>
                        
                        
                        <div class="center_button"  style=" padding-top:50px;"><button class="btn btn-success" id="btn_addlist"><i class="icon-ok"></i>确认添加</button></div>
                    </div>
                </div>
                <div  style=" width:200px;float:left; height:300px; overflow:auto; border:solid 1px #999999;">
                    <ul class="activity-list" id="dish_right">
                    </ul>    
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
	common.includeFile( {type : 'css',url : '/resources/css/datepicker.css'});
	common.includeFile( {type : 'css',url : '/resources/css/font-awesome/css/font-awesome.css'});
	common.includeFile( {type : 'css',url : 'http://fonts.googleapis.com/css?family=Open+Sans:400,700,800'});
	
})
var dish_list = null;
var istrue= false;
$(document).ready(function(){
	
	$('input[type=checkbox],input[type=radio]').uniform();
	
	//$('select').select2();
	
	// Form Validation
    $("#basic_validate").validate({
		rules:{
    		date_from:{
				required:true,
				date:true
			},
			date_to:{
				required:true,
				date:true,
				remote:{
				　　 type:"POST",
				　　 url:"/default/menu/ajax", 
				　　 data:{action:'getDate',d_s:function(){return $("#date_from").val();},d_e:function(){return $("#date_to").val();}}
			　　} 
			}
　　 
		},
		errorClass: "help-inline",
		errorElement: "span",
		highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents('.control-group').removeClass('error');
			$(element).parents('.control-group').addClass('success');
		},
		messages: {
			date_to: {
				remote: "日期重复!"
			}
		}
	});
	$("#date_from" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths: 2,
		dateFormat:'yy-mm-dd',
		onClose: function( selectedDate ) {
			$("#date_to").datepicker( "option", "minDate", selectedDate );
		}
	});
	$( "#date_to" ).datepicker({
		defaultDate: "+1w",
		changeMonth: true,
		numberOfMonths:2,
		dateFormat:'yy-mm-dd',
		onClose: function( selectedDate ) {
			$( "#date_from" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
	
	$('#dish_select').click(function(){getdish();});
});

function getdish(opts){
	var defaults = {
				keyword: '',
				page : 1,
				pagesize : 100
		}, myopts = $.extend({}, defaults, opts || {})
		
	$.ajax({
		type: "POST",
		url: "/default/dish/ajax",
		data: ({action:'dishlist',k:myopts.keyword,p:myopts.page,pz:myopts.pagesize}),
		dataType: "json",
		global:false,
		timeout:15000,
		success: function(data){
			dish_list = data;
			filldish(data);
		},beforeSend:function(){},
		error:function(s,error){}
	});
}


function filldish(data){
	var list = data;
	var ilist = data.length;
	shtml = '';
	rhtml = '';
	var sel_dish = new Array();
	//得到已经被选中过的菜品
	$('#dish_list').find('tr').each(function(){
		/*alert($(this).find("input[id='id']").val());
		alert($(this).find("input[id='name']").val());
		alert($(this).find("input[id='price']").val());*/
		sel_dish.push($(this).find("input[id='id']").val());
		rhtml += '<li data-value="'+$(this).find("input[id='id']").val()+'" data-name="'+$(this).find("input[id='name']").val()+'" data-price="'+$(this).find("input[id='price']").val()+'"><a >'
		rhtml += '<i class="icon-gift"></i> '+$(this).find("input[id='name']").val()+'</a></li>';
	})
	
	for (i=0;i<ilist;i++)
	{
		info = list[i];
		if (!sel_dish.contains(info.id)){
			shtml +=  '<li data-value="'+info.id+'" data-name="'+info.name+'" data-price="'+info.price+'"><a ><i class="icon-gift"></i> '+info.name+'</a></li>';
		}
	}
	
	
	$('#dish_left').html(shtml);
	$('#dish_right').html(rhtml);
	
	$('#dish_left').find('li').bind('click',function(){
		$(this).toggleClass( 'select_li', '' );
	});
	bind_btn();
	showSelect();
}

// 判断数组中包含element元素
Array.prototype.contains = function (element) {
  
    for (var i = 0; i < this.length; i++) {
        if (this[i] == element) {
            return true;
        }
    }
    return false;
}

function showSelect(){
	$(document.body).append('<div class="modal-backdrop in"></div>')
	$('#myModal').addClass('in').css({'display':'block'}).attr('aria-hidden',false);
	$('#myModal').find('button.close').unbind('click').bind('click',function(){
		hideSelect();
	})
}
function hideSelect(){
	$('#myModal').removeClass('in').css({'display':'none'}).attr('aria-hidden',true);
	$('.modal-backdrop').remove();
}

function bind_btn(){
	$('#mvoer').unbind('click').bind('click',function(){
		$('#dish_left').find('li[class="select_li"]').removeClass('select_li').appendTo('#dish_right');
		
	});
	$('#mvoel').unbind('click').bind('click',function(){
		$('#dish_right').find('li[class="select_li"]').removeClass('select_li').appendTo('#dish_left');
	});
	
	$('#mover_all').unbind('click').bind('click',function(){
		$('#dish_left').find('li').removeClass('select_li').appendTo('#dish_right');
	});
	$('#mvoel_all').unbind('click').bind('click',function(){
		$('#dish_right').find('li').removeClass('select_li').appendTo('#dish_left');
	});
	$('#btn_addlist').unbind('click').bind('click',function(){
		shtml = ''
		if ($('#dish_right').find('li').length>0){
			$('#dish_right').find('li').each(function( index ) {
			  //alert($(this).attr('data-value'));
			  shtml += '<tr class="odd"><td class="center">'+$(this).attr('data-value')+'<input type="hidden" id="id"  name="ids[]"  value="'+$(this).attr('data-value')+'"></td>'
			   shtml += '<td class="center"><input type="text" id="name"  name="name[]"  value="'+$(this).attr('data-name')+'"></td>';
			  shtml += '<td class="center"><input type="text"   id="price"  name="price[]"  value="'+$(this).attr('data-price')+'"></td>';
			  shtml += '<td class="center"><input type="text"   name="reverse[]"  value=""></td>';
			  shtml += '<td class="center"><div class="center_button"><button class="btn btn-mini" type="button" title="remove"><i class="icon-remove"></i></button></div></td></tr>';
			});
		}
		$('#dish_list').append(shtml);
		$('#dish_list').find("button[title='remove']").unbind('click').bind('click',function(){
			 $(this).parents('tr').remove();
		});
		$('#selected_dish').css({'display':'block'})
		hideSelect();
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