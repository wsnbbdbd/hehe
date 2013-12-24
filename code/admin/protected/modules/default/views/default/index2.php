<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Tables</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Data table</h5>
            <a class="" href="#"><span class="label label-success">Add</span></a>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>编号</th>
                  <th>名称</th>
                  <th>操作</th>
                </tr>
              </thead>
             <tbody>
             	<?php foreach ($obj_list as $obj_info){ ?>
             		<tr class="gradeA">
                  <td><?php echo $obj_info['id'];?></td>
                  <td><?php echo $obj_info['name'];?></td>
                  <td class="center" style="text-align: center;">
                  <a class="tip" href="#" title="Edit"><i class="icon-pencil"></i></a>
                  <a class="tip" href="#" title="Delete"><i class="icon-remove"></i></a>
					<!-- <a href="#" class="tip-top" data-original-title="Update"><i class="icon-ok"></i></a>
					<a href="#" class="tip-top" data-original-title="Delete"><i class="icon-remove"></i></a>-->
					<div class="fr"><!--<a class="btn btn-primary btn-mini" href="#">Edit</a>
					<a class="btn btn-success btn-mini" href="#">Publish</a>
					<a class="btn btn-danger btn-mini" href="#">Delete</a>-->
					</div></td>
                </tr>
             	<?php }?>
              </tbody>
            </table>
          </div>
          <div class="widget-content nopadding ">
          	<?php $this->widget('Pagination', array('arr_page_param' => $arr_page_param)); ?>
            <!--<div class="pagination fr">
              <ul>
                <li><a href="#">Prev</a></li>
                <li class="active"> <a href="#">1</a> </li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li class="disabled"><a>...</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">Next</a></li>
              </ul>
            </div>
          </div>-->
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
})
</script>

