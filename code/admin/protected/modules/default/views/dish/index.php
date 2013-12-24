<div id="content">
  <div id="content-header">
    <!-- <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div> -->
    <h1>菜品管理</h1>
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
                	<label class="span3 m-wrap">名称:</label>
                	<div class="span9 m-wrap">
	                	<input type="text" class="span10 m-wrap" name="n" id="name" value="<?php echo $arr_search['n'];?>" />
	                	
	               </div>
                </div>
                <div class="span3 m-wrap">
                	<label class="span3 m-wrap">类型:</label>
                	<div class="span9 m-wrap">
						<select id="format" class="span9 m-wrap" name="tp">
							<option value="">--</option>
							<?php foreach($arr_type as $key=>$type){?>
							<option value="<?php echo $key;?>" <?php echo (($arr_search['tp']==$key)?'selected':''); ?>><?php echo $type;?></option>
							<?php }?>
						</select>
	                </div>
                </div>
                <div class="span3 m-wrap ">
                	<label class="span3 m-wrap">价格:</label>
                	<div class="span9 m-wrap">
						<input type="text" class="span6 m-wrap" name="p_s" id="price_from"  value="<?php echo $arr_search['p_s'];?>"/>
	                	<input type="text" class="span6 m-wrap" name="p_e" id="price_to" value="<?php echo $arr_search['p_e'];?>"/>
                	</div>
                </div>
                <div class="span3 m-wrap"> <button class="btn btn-primary" type="submit" style="background-color:#28B779;" ><i class="icon-search icon-white"></i> 查询</button></div>
              </div>
               
            </div>
          </div>
         </form>
    </div>
    
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>菜品列表</h5>
            <a class="" href="/default/dish/add"><span class="label label-success">添加</span></a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>缩略图</th>
                  <th>名称</th>
                  <th>类型</th>
                  <th>价格</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
              </thead>
             <tbody>
             	<?php foreach ($obj_list as $obj_info){ ?>
             		<tr class="gradeA">
	                  <td><?php echo $obj_info['id'];?></td>
	                  <td style="text-align: center;">
					   <a class="tip" href="/default/dish/edit?id=<?php echo $obj_info['id'];?>" title="点击查看大图"><img src="<?php if ($obj_info->image){ echo $obj_info->image[0]['imgUrl'];}?>" width="120" height="80" /></a>
					  </td>
	                  <td><?php echo $obj_info['name'];?></td>
	                  <td><?php echo $arr_type[$obj_info['type']];?></td>
	                  <td><?php echo $obj_info['price'];?></td>
	                  <td class="center" style="text-align: center;"><?php echo ($obj_info['status'])?'<span class="badge badge-success">正常</span>':'<span class="badge badge-warning">取消</span>';?></td>
	                  <td class="center" style="text-align: center;">
	                  <a class="tip" href="/default/dish/edit?id=<?php echo $obj_info['id'];?>" title="编辑"><i class="icon-pencil"></i></a>
	                  <a class="tip" href="##"  data-value="<?php echo $obj_info['id'];?>" title="删除" op="delete"><i class="icon-remove"></i></a>
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
<script src="/resources/scripts/jquery.dataTables.min.js"></script> 
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
	
	$("a[op='delete']").bind('click',function(){
		if (window.confirm("是否将此信息删除?")){
			//alert($(this).attr('data-value'));
			location.href = "/default/dish/delete?id="+$(this).attr('data-value');
		}
		
	})
})

</script>

