<div id="content">
  <div id="content-header">
    <!-- <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div> -->
    <h1>用户管理</h1>
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
                	<label class="span3 m-wrap">账号:</label>
                	<div class="span9 m-wrap">
	                	<input type="text"  class="span12 m-wrap" name="ac" value="<?php echo $arr_search['ac'];?>">
	               </div>
                </div>
                <div class="span3 m-wrap">
                	<label class="span3 m-wrap">姓名:</label>
                	<div class="span9 m-wrap">
						<input type="text"  class="span12 m-wrap" name="n" value="<?php echo $arr_search['n'];?>">
	                </div>
                </div>
                <div class="span3 m-wrap ">
                	<label class="span3 m-wrap">积分:</label>
                	<div class="span9 m-wrap">
						<input type="text" class="span6 m-wrap" name="in_s" id="integral_from"  value="<?php echo $arr_search['in_s'];?>"/>
	                	<input type="text" class="span6 m-wrap" name="in_e" id="integral_to" value="<?php echo $arr_search['in_e'];?>"/>
                	</div>
                </div>
                <div class="span3 m-wrap"> </div>
              </div>
               <div class="controls controls-row">
              	<div class="span4 m-wrap">
                	<label class="span3 m-wrap">登陆时间:</label>
                	<input type="text" class="span9 m-wrap" name="dt_lg" id="login_time" value="<?php echo $arr_search['dt_lg'];?>" />
                </div>
                <div class="span4 m-wrap">
                	<label class="span3 m-wrap">账号状态:</label>
                	<select id="format" class="span9 m-wrap" name="st">
						<option value="">--</option>
						<option <?php echo (($arr_search['st']==1)?'selected':''); ?> value="1">启用</option>
                        <option <?php echo (($arr_search['st']==-1)?'selected':''); ?> value="-1">冻结</option>
					</select >	
                </div>
                <div class="span2 m-wrap"> </div>
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
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>用户列表</h5>
            <!-- <a class="" href="/user/user/add"><span class="label label-success">添加用户</span></a> -->
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>账号</th>
                  <th>电话</th>
                  <th>积分</th>
                  <th>状态</th>
                  <th>操作</th>
                </tr>
              </thead>
             <tbody>
             	<?php
				if (!empty($obj_list)){
             		foreach ($obj_list as $obj_info){ ?>
             		<tr class="gradeA">
	                  <td><?php echo $obj_info['id'];?></td>
	                  <td><?php echo $obj_info['account'];?></td>
	                  <td><?php echo $obj_info['mobile'];?></td>
                      <td><?php echo sprintf('%.2f',$obj_info['integral']);?></td>
	                  <td class="center" style="text-align: center;"><?php echo ($obj_info['status'])?'<span class="badge badge-success">正常</span>':'<span class="badge badge-warning">冻结</span>';?></td>
	                  <td class="center" style="text-align: center;">
	                  <a class="tip" href="/user/user/edit?id=<?php echo $obj_info['id']; ?>" title="编辑"><i class="icon-pencil"></i></a>
	                <!--   <a class="tip" href="##" op="delete" title="冻结"><i class="icon-remove"></i></a>
					<a href="#" class="tip-top" data-original-title="Update"><i class="icon-ok"></i></a>
					<a href="#" class="tip-top" data-original-title="Delete"><i class="icon-remove"></i></a>-->
					<!--<div class="fr"><a class="btn btn-primary btn-mini" href="#">Edit</a>
					<a class="btn btn-success btn-mini" href="#">Publish</a>
					<a class="btn btn-danger btn-mini" href="#">Delete</a>
					</div> --></td>
                </tr>
             	<?php }} ?>
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
		if (window.confirm("是否将此用户冻结!")){
			location.href = "/user/user/delete?id="+$(this).attr('data-value');
		}
	})
	
})
</script>

