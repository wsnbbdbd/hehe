<?php
class DefaultController extends Controller {
	
	public function actionIndex(){
		$this->render('index');
	}
	
	public function actionPage(){
		
		$request = Yii::app()->getRequest();
		
		$int_page = $request->getParam('sEcho')? $request->getParam('sEcho') : 1;
		$list = array();
		$search = array();
		
		$criteria=new CDbCriteria();
		/*$criteria=new CDbCriteria(array(
			'order'=>'good_id DESC'
		));
		$good_name = trim($request->getParam('good_name'));
		$status = trim($request->getParam('status'));
		$search['good_name'] = $good_name;
		$search['status'] = $status;
		//组合条件
		if (!empty($good_name) && $good_name!=''){
			$criteria->addCondition("good_name like :name"); 
			$criteria->params[':name']= '%'.$good_name.'%';
		}
		if ($status!=''){
			$criteria->addCondition("status = :status"); 
			$criteria->params[':status']=$status;
		}*/
		$model_simple = new Simple();
        $int_count = $model_simple->count($criteria);
        /*$pager = new CPagination($count);
        $pager->pageSize = Yii::app()->params['postsPerPage'];
        $pager->setCurrentPage($page-1);
        $pager->applyLimit($criteria);*/
        $list = $model_simple->findAll($criteria);
        
		/*print_r($list);
		exit;*/
        $ret_array = self::ARtoArray($list);
		//print_r($ret_array);
        
        $output = array(
			"sEcho" => $int_page,//intval($_GET['sEcho']),
			"iTotalRecords" => $int_count,
			"iTotalDisplayRecords" => $int_count,
			"aaData" => $ret_array
		);
		/*$output = array(
			"sEcho" => $int_page,//intval($_GET['sEcho']),
			"iTotalRecords" => 0,
			"iTotalDisplayRecords" => 0,
			"aaData" => array()
		);*/
		echo json_encode($output);
        exit;
		
	}
	public function actionPage2(){
		$obj_request = Yii::app()->getRequest();
		$int_page = $obj_request->getParam('page');
		$int_page = !empty($int_page) ? intval($int_page) : 1;
		$int_page_size =  Yii::app()->params['postsPerPage'];
		//$int_page_size = 10;
		
		
		//$obj_criteria=new CDbCriteria();
		$obj_criteria=new CDbCriteria(array(
			'order'=>'id DESC'
		));
		/*$good_name = trim($request->getParam('good_name'));
		$status = trim($request->getParam('status'));
		$search['good_name'] = $good_name;
		$search['status'] = $status;
		//组合条件
		if (!empty($good_name) && $good_name!=''){
			$criteria->addCondition("good_name like :name"); 
			$criteria->params[':name']= '%'.$good_name.'%';
		}
		if ($status!=''){
			$criteria->addCondition("status = :status"); 
			$criteria->params[':status']=$status;
		}*/
		$model_simple = new Simple();
        $int_count = $model_simple->count($obj_criteria);
        $pager = new CPagination($int_count);
        $pager->pageSize = $int_page_size;
        $pager->setCurrentPage($int_page-1);
        $pager->applyLimit($obj_criteria);
        $obj_list = $model_simple->findAll($obj_criteria);
		//print_r($list);
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => $int_count,
		);
		$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_page_param'=>$arr_page_param
							,'obj_list'=>$obj_list);
		
		$this->render('index2',$arr_render);
		
	}
	
	public function actionAdd(){
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
			$datas = array(
	  			'adv_set'    => trim($request->getParam('adv_set')),
	  			'adv_name'       => trim($request->getParam('adv_name')),
	  			'adv_link'       => trim($request->getParam('adv_link')),
			    'adv_mark'       => trim($request->getParam('adv_mark')),
	  		    'adv_linktype'       => trim($request->getParam('adv_linktype')),
	  			'status'    => intval($request->getParam('status'))
	  		);
	  	   
			$image = CUploadedFile::getInstanceByName('adv_img');
	  		$adv_img = '';
	  		if(isset($image)){
				$imageinfo = Upload::UpdateImage($image,'adver');
				if ($imageinfo['code']!=1){
					echo($imageinfo['msg']);
					exit;
				}
				$adv_img = $imageinfo['img'];
				$datas['adv_img'] = $adv_img;
  			}
	  		
			try{
				$model = new Adver();
				$model->_attributes = $datas;
				if ($model->insert()){
					$this->showTip('成功','数据提交成功');
				}else{
					$this->showTip('失败','请稍候重试','error');
				}
				$this->redirect(array('list'));
			}catch (Exception $re){
				throw Exception($re);
			}
  		
		}else{
			$adver_set = Yii::app()->params['adver_set'];
			$this->render('add',array('r'=>Yii::app()->request->baseUrl.'/'));
		}
		
	}
	
	/**
  	 * +++++++++++++++++++++
  	 * 编辑广告
  	 * +++++++++++++++++++++
  	 */
	public function actionEdit(){
		
		$model = new Adver();
		$request = Yii::app()->getRequest();
  	    $id = trim($request->getParam("id"));
		try{
			$rs = $model->find('adv_id=:id',array(':id'=>$id));
			//print_r($data);
			
		}catch(Exception $e){
			throw Exception($e);
		}
		
		if(!empty($_POST)){
	  		
	  		$datas = array(
	  			'adv_set'    => trim($request->getParam('adv_set')),
	  			'adv_name'       => trim($request->getParam('adv_name')),
	  			'adv_link'       => trim($request->getParam('adv_link')),
	  			'adv_mark'       => trim($request->getParam('adv_mark')),
	  		    'adv_linktype'       => trim($request->getParam('adv_linktype')),
	  			'status'    => intval($request->getParam('status'))
	  		);
	  	   
			$image = CUploadedFile::getInstanceByName('adv_img');
	  		$adv_img = '';
	  		if(isset($image)){
				$imageinfo = Upload::UpdateImage($image,'adver');
				if ($imageinfo['code']!=1){
					echo($imageinfo['msg']);
					exit;
				}
				$adv_img = $imageinfo['img'];
				$datas['adv_img'] = $adv_img;
  			}
			try{
				$rs->_attributes = $datas;
				$rs->setIsNewRecord(false);
				if ($rs->update()){
					$this->showTip('成功','数据提交成功');
				}else{
					$this->showTip('失败','请稍候重试','error');
				}
				$this->redirect(array('list'));
			}catch (Exception $re){
				throw Exception($re);
			}
  		
		}else{
			$adver_set = Yii::app()->params['adver_set'];
			$this->render('edit',array('r'=>Yii::app()->request->baseUrl.'/','adver_set' => $adver_set,'datas' => $rs));
		}
	}
  	
	/**
  	 * +++++++++++++++++++++
  	 * 删除广告
  	 * +++++++++++++++++++++
  	 */
	public function actionDel(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		if($id){
			try{
				$model = new Adver();
				$row = $model->find('adv_id=:id',array(':id'=>$id));
				if ($row->delete()){
					$this->showTip('成功','数据删除成功');
				}else{
					$this->showTip('失败','请稍候重试','error');
				}
				$this->redirect(array('list'));
			}catch (Exception $e){
				throw Exception($e);
			}
		}
	}
	

	/**
	 * 
	 * 专辑图片上传
	 * $arr_params 
	 * $arr_params = array(
	 * 	arr_imgs 要上传的文件集
	 *  int_dataset_id 剧集ID
	 * )
	 */
	
	public function uploadPic($arr_params){
		//v($arr_params['arr_imgs']);
		// 实例化上传类
		$upload = new UploadFile();
		
		// 设置附件上传大小，单位kb   
		$upload->int_max_size  = 3145728 ;
		// 设置附件上传类型
		$upload->arr_allow_exts  = array('jpg', 'gif', 'png', 'jpeg');
		// 设置附件上传目录  
		$upload->str_save_path =  './uploads/dataset_gallery/';
		//执行上传 
		$arr_big_rs=$upload->upload($arr_params['arr_imgs']['arr_big']);
		$arr_big_imgs = $arr_big_rs['arr_data']['arr_data'];
		$arr_small_rs=$upload->upload($arr_params['arr_imgs']['arr_small']);
		$arr_small_imgs = $arr_small_rs['arr_data']['arr_data'];
		//v($arr_imgs);
		
		//数据入库
		$arr_params2 = array(
	 		'int_dataset_id' => $arr_params['int_dataset_id'], //剧集编号
	  		'arr_small' => $arr_small_imgs,
			'arr_big' => $arr_big_imgs,
			'arr_info' => $arr_params['arr_imgs']['arr_info'],
	     );
		$obj_callery = new DatasetGallery();
		$obj_callery->insertDatas($arr_params2);
		//echo(json_encode($arr_re['arr_data']['arr_data']));
	}
/**
	 *导出数据
	 */
	public function excelExport($arr_datas,$arr_shift_status){
		//v($arr_datas,1);
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
	public function getARAttr($record){
		return $record->attributes;
	}
	public function ARtoArray($activerecord){
		$array = array();
		if (!empty($activerecord)){
			$array= array_map('self::getARAttr',$activerecord);
		}
		return $array;
	}
}