<?php
class UserController extends Controller {
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
		
		
		$account = trim($obj_request->getParam('ac'));
		$name = trim($obj_request->getParam('n'));
		$in_s = trim($obj_request->getParam('in_s'));
		$in_e = trim($obj_request->getParam('in_e'));
		$login_time = trim($obj_request->getParam('dt_lg'));
		$status = trim($obj_request->getParam('st'));
		
		$arr_search['ac'] = $account;
		$arr_search['n'] = $name;
		$arr_search['in_s'] = $in_s;
		$arr_search['in_e'] = $in_e;
		$arr_search['dt_lg'] = $login_time;
		$arr_search['st'] = $status;
		//组合条件
		if (!empty($account) && $account!=''){
			$obj_criteria->addCondition("account like :ac"); 
			$obj_criteria->params[':ac']= '%'.$account.'%';
		}
		if (!empty($name) && $name!=''){
			$obj_criteria->addCondition("name like :nm"); 
			$obj_criteria->params[':nm']= '%'.$name.'%';
		}
		if (!empty($in_s) && $in_s!=''){
			$obj_criteria->addCondition("integral >= :in_s"); 
			$obj_criteria->params[':in_s']= $in_s;
		}
		if (!empty($in_e) && $in_e!=''){
			$obj_criteria->addCondition("integral <= :in_e"); 
			$obj_criteria->params[':in_e']= $in_e;
		}
		if ($status!=''){
			$obj_criteria->addCondition("status = :status"); 
			$obj_criteria->params[':status']=$status;
		}
		
		$model_user = new User();
        $int_count = $model_user->count($obj_criteria);
        $pager = new CPagination($int_count);
        $pager->pageSize = $int_page_size;
        $pager->setCurrentPage($int_page-1);
        $pager->applyLimit($obj_criteria);
        $obj_list = $model_user->findAll($obj_criteria);
        
		//print_r($list);
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => $int_count,
		);
		$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_page_param'=>$arr_page_param
							,'obj_list'=>$obj_list
							,'arr_search'=>$arr_search
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
			$this->render('add',array('r'=>Yii::app()->request->baseUrl.'/'));
		}
		
	}
	
	/**
  	 * 编辑
  	 */
	public function actionEdit(){
		$request = Yii::app()->getRequest();
		$id = trim($request->getParam("id"));
		
		$obj_model_user = new User();
		$obj_model_address = new Address();
		$obj_model_userlog = new UserLog();
		
		try{
			
			$obj_user = $obj_model_user->find('id=:id',array(':id'=>$id));
			$obj_address_list = $obj_model_address->findAll('account=:account',array(':account'=>$obj_user['account']));
			$obj_userlog = $obj_model_userlog->findAll('account=:account',array(':account'=>$obj_user['account']));
			
		}catch(Exception $e){
			throw Exception($e);
		}
		
		//print_r($obj_user->attributes);
		//exit;
		if(!empty($_POST)){
	  		
	  		$datas = array(
	  			'id'    => trim($request->getParam('id')),
	  			'name'       => trim($request->getParam('name')),
	  			'birthday'       => trim($request->getParam('birthday')),
			    'status'       => intval($request->getParam('status')),
	  		    'QQ'       => trim($request->getParam('QQ')),
	  			'weiboAccount'       => trim($request->getParam('weiboAccount'))
	  		);
	  		
			try{
				$obj_user->_attributes = $datas;
				$obj_user->setIsNewRecord(false);
				$obj_user->update();
				$this->redirect(array('index'));
			}catch (Exception $re){
				throw Exception($re);
			}
  			
		}else{
			$this->render('edit',array('r'=>Yii::app()->request->baseUrl.'/'
			,'address' => $obj_address_list
			,'datas' => $obj_user
			,'userlog' => $obj_userlog
			,'address_type' => Yii::app()->params['address_type']
			));
		}
	}
	
	public function actionAjax(){
		$obj_request = Yii::app()->getRequest();
		$str_action = $obj_request->getParam('action');
		
		switch ($str_action){
			case 'getuserinfo':
				$str_account = $obj_request->getParam('account');
				$obj_criteria  = new CDbCriteria();
				//组合条件
				if (!empty($str_account) && $str_account!=''){
					$obj_criteria->addCondition("account = :account"); 
					$obj_criteria->params[':account']= $str_account;
				}
				$userinfo = array();
				$obj_model_user = new User();
		        $obj_user = $obj_model_user->find($obj_criteria);
		        if($obj_user){
		        	$userinfo =$obj_user->attributes;
		        }
		        $model_address = new Address();
		        $obj_address_list = $model_address->findAll($obj_criteria);
		        $arr_address_list = PublicFunction::ARtoArray($obj_address_list);
				//print_r($arr_list);
				$arr_info = array('user'=>$userinfo,'address'=>$arr_address_list,'type'=>Yii::app()->params['address_type']);
				exit(json_encode($arr_info));
				break;
		}
		
		
		
	}

}