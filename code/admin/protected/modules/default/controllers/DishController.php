<?php
class DishController extends Controller {
	
	/*
	 * 列表
	 */
	public function actionIndex(){
		$obj_request = Yii::app()->getRequest();
		$int_page = $obj_request->getParam('page');
		$int_page = !empty($int_page) ? intval($int_page) : 1;
		$int_page_size =  Yii::app()->params['postsPerPage'];
		
		$obj_criteria=new CDbCriteria(array(
			'order'=>'id DESC'
		));
		$name = trim($obj_request->getParam('n'));
		$type = trim($obj_request->getParam('tp'));
		$price_start = trim($obj_request->getParam('p_s'));
		$price_end = trim($obj_request->getParam('p_e'));
		$search['n'] = $name;
		$search['tp'] = $type;
		$search['p_s'] = $price_start;
		$search['p_e'] = $price_end;
		//组合条件
		if (!empty($name) && $name!=''){
			$obj_criteria->addCondition("name like :name"); 
			$obj_criteria->params[':name']= '%'.$name.'%';
		}
		if ($type!=''){
			$obj_criteria->addCondition("type = :tp"); 
			$obj_criteria->params[':tp']=$type;
		}
		if ($price_start!=''){
			$obj_criteria->addCondition("price >= :p_s"); 
			$obj_criteria->params[':p_s']=$price_start;
		}
		if ($price_end!=''){
			$obj_criteria->addCondition("price <= :p_e"); 
			$obj_criteria->params[':p_e']=$price_end;
		}
		
		
		
		$model_dish = new Dish();
        $int_count = $model_dish->count($obj_criteria);
        $pager = new CPagination($int_count);
        $pager->pageSize = $int_page_size;
        $pager->setCurrentPage($int_page-1);
        $pager->applyLimit($obj_criteria);
        $obj_list = $model_dish->with('image')->findAll($obj_criteria);
		//print_r($obj_list);
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => $int_count,
		);
		$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_page_param'=>$arr_page_param
							,'obj_list'=>$obj_list
							,'arr_type'=>Yii::app()->params['dish_type']
							,'arr_search'=>$search
							);
		
		$this->render('index',$arr_render);
	}

	/*
	 * 添加
	 */
	public function actionAdd(){
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$datas = array(
	  			'name'    => trim($request->getParam('name')),
	  			'type'       => trim($request->getParam('type')),
	  			'price'       => trim($request->getParam('price')),
			    'status'       => intval($request->getParam('status')),
	  		    'description'       => trim($request->getParam('description'))
	  		);
	  		
	   		$arr_img = $_FILES['pictrue'];
	   		
	  		if(empty($datas)){
	  			return false;
	  		}
			try{
				$obj_model_dish = new Dish();
				$obj_model_dish->setIsNewRecord(true);
				$obj_model_dish->_attributes = $datas;
				if ($obj_model_dish->insert()){
					$arr_params = array(
						'arr_imgs'	=> array(
							'pictrue' => $arr_img
						),
					    'int_dish_id' => $obj_model_dish->getPrimaryKey()
					);
					self::uploadPic($arr_params);
					//$this->showTip('成功','数据提交成功');
				}else{
					//$this->showTip('失败','请稍候重试','error');
				}
				$this->redirect(array('index'));
			}catch (Exception $re){
				throw Exception($re);
			}
  		
		}else{
			$this->render('add',array('r'=>Yii::app()->request->baseUrl.'/','arr_type'=>Yii::app()->params['dish_type']));
		}
		
	}
	
	/**
  	 * 编辑
  	 */
	public function actionEdit(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		
		$obj_model_dish = new Dish();
		$obj_model_dishimage = new Dishimage();
		try{
			$obj_dish = $obj_model_dish->find('id=:id',array(':id'=>$id));
			$obj_dishimage = $obj_model_dishimage->findAll('dishId=:id',array(':id'=>$id));
			
		}catch(Exception $e){
			throw Exception($e);
		}
		
		if(!empty($_POST)){
	  		
	  		$datas = array(
	  			'name'    => trim($request->getParam('name')),
	  			'type'       => trim($request->getParam('type')),
	  			'price'       => trim($request->getParam('price')),
			    'status'       => intval($request->getParam('status')),
	  		    'description'       => trim($request->getParam('description'))
	  		);
	  		
	   		$arr_img = $_FILES['pictrue'];
	   		
	  		if(isset($arr_img)){
	  			
	  			$obj_model_dishimage = new Dishimage();
				$obj_dishimages = $obj_model_dishimage->deleteAll('dishId=:id',array(':id'=>$id));
				$arr_params = array(
					'arr_imgs'	=> array(
						'pictrue' => $arr_img
					),
				    'int_dish_id' => $id
				);
				self::uploadPic($arr_params);
  			}
  			
			try{
				$obj_dish->_attributes = $datas;
				$obj_dish->setIsNewRecord(false);
				$obj_dish->update();
				$this->redirect(array('index'));
			}catch (Exception $re){
				throw Exception($re);
			}
  			
		}else{
			$this->render('edit',array('r'=>Yii::app()->request->baseUrl.'/','datas' => $obj_dish,'images'=>$obj_dishimage,'arr_type'=>Yii::app()->params['dish_type']));
		}
	}
  	
	/**
  	 * 删除
  	 */
	public function actionDelete(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$obj_model_dish = new Dish();
				$obj_dish = $obj_model_dish->find('id=:id',array(':id'=>$id));
				$obj_dish->delete();
				
				$obj_model_dishimage = new Dishimage();
				$obj_dishimages = $obj_model_dishimage->deleteAll('dishId=:id',array(':id'=>$id));
				$this->redirect(array('index'));
			}catch (Exception $e){
				throw Exception($e);
			}
		}
	}
	
	
	public function actionAjax(){
		$obj_request = Yii::app()->getRequest();
		$str_action = $obj_request->getParam('action');
		
		switch ($str_action){
			case 'dishlist':
				$int_page = $obj_request->getParam('p');
				$int_page = !empty($int_page) ? intval($int_page) : 1;
				$int_page_size =  $obj_request->getParam('pz');
				$obj_criteria=new CDbCriteria(array(
					'order'=>'id DESC'
				));
				$good_name = trim($obj_request->getParam('k'));
				
				//组合条件
				if (!empty($good_name) && $good_name!=''){
					$criteria->addCondition("name like :name"); 
					$criteria->params[':name']= '%'.$good_name.'%';
				}
				
				$model_dish = new Dish();
		        $int_count = $model_dish->count($obj_criteria);
		        $pager = new CPagination($int_count);
		        $pager->pageSize = $int_page_size;
		        $pager->setCurrentPage($int_page-1);
		        $pager->applyLimit($obj_criteria);
		        $obj_list = $model_dish->findAll($obj_criteria);
		        $arr_list = PublicFunction::ARtoArray($obj_list);
				//print_r($arr_list);
				exit(json_encode($arr_list));
				break;
		}
		
		
		
	}

	/**
	 * 
	 * 图片上传
	 * $arr_params 
	 * $arr_params = array(
	 * 	arr_imgs 要上传的文件集
	 *  int_dataset_id 剧集ID
	 * )
	 */
	
	public function uploadPic($arr_params){
		// 实例化上传类
		$upload = new UploadFile();
		
		// 设置附件上传大小，单位kb   
		$upload->int_max_size  = 3145728 ;
		// 设置附件上传类型
		$upload->arr_allow_exts  = array('jpg', 'gif', 'png', 'jpeg');
		// 设置附件上传目录
		$_img_dir ='/upload/dish';
		$_priv_img_dir = 'E:/hehelife/code/admin';
		
		$upload->str_save_path = $_priv_img_dir.$_img_dir;
		//执行上传 
		$arr_image=$upload->upload($arr_params['arr_imgs']['pictrue']);
		
		//数据入库
		$arr_params2 = array(
	 		'dishId' => $arr_params['int_dish_id'],
	  		'name' => '',
			'imgUrl' => trim($_img_dir.$arr_image['arr_data']['arr_data'][0]['savename'],".")
	    );
	    
		$obj_model_dishimage = new Dishimage();
		$obj_model_dishimage->_attributes = $arr_params2;
		$obj_model_dishimage->setIsNewRecord(true);
		$obj_model_dishimage->insert();
	}
	/**
	 *导出数据
	 */
	public function excelExport($arr_datas,$arr_shift_status){
		$str_export_name = '成片信息_'.date('Y-m-d');
		$arr_export_title = array('序号','成片名','商品价格','内容大小','成片条数','上载时间','上架状态');
		$arr_export_datas = array();
		
		foreach( $arr_datas as $k => $item ){
			
			$arr_exprot_datas[] = array(
				$k+1,
				$item['name'],
				sprintf('%.2f', $item['price']),
				$item['size'].'mb',
				$item['contentCount'],
				$item['insertTime'],
				$arr_shift_status[$item['shiftStatus']],
				);
		}
		
		$obj_excel=new Excel();
		$obj_excel->export($arr_export_title, $arr_exprot_datas,$str_export_name );
	}
}