<?php
class DefaultController extends Controller {
	
	public function actionIndex(){
		$obj_request = Yii::app()->getRequest();
		$int_page = $obj_request->getParam('page');
		$int_page = !empty($int_page) ? intval($int_page) : 1;
		$int_page_size =  Yii::app()->params['postsPerPage'];
		$arr_search = array();
		$obj_criteria=new CDbCriteria(array(
			'order'=>'id DESC'
		));
		
		
		//组合条件
		//下单时间
		$date_order_start = $obj_request->getParam('o_s');
		$date_order_end = $obj_request->getParam('o_e');
		$arr_search['o_s'] = '';
		$arr_search['o_e'] = '';
		if (!empty($date_order_start) && $date_order_start!=''){
			$obj_criteria->addCondition("DATEDIFF(insertTime,:o_s)>=0 "); 
			$obj_criteria->params[':o_s']= $date_order_start;
			$arr_search['o_s'] = $date_order_start;
		}
		if (!empty($date_order_end) && $date_order_end!=''){
			$obj_criteria->addCondition("DATEDIFF(insertTime,:o_e)<=0 "); 
			$obj_criteria->params[':o_e']= $date_order_end;
			$arr_search['o_e'] = $date_order_end;
		}
		
		//配送时间
		$date_distribe_start = $obj_request->getParam('d_s');
		$date_distribe_end = $obj_request->getParam('d_e');
		$arr_search['d_s'] = '';
		$arr_search['d_e'] = '';
		if (!empty($date_distribe_start) && $date_distribe_start!=''){
			$obj_criteria->addCondition("DATEDIFF(deliveryTime,:d_s)>=0 "); 
			$obj_criteria->params[':d_s']= $date_distribe_start;
			$arr_search['d_s'] = $date_distribe_start;
		}
		if (!empty($date_distribe_end) && $date_distribe_end!=''){
			$obj_criteria->addCondition("DATEDIFF(deliveryTime,:d_e)<=0 "); 
			$obj_criteria->params[':d_e']= $date_distribe_end;
			$arr_search['d_e'] = $date_distribe_end;
		}
		
		$int_price_start = $obj_request->getParam('p_s');
		$int_price_end = $obj_request->getParam('p_e');
		$arr_search['p_s'] = '';
		$arr_search['p_e'] = '';
		if (!empty($int_price_start) && $int_price_start!=''){
			$obj_criteria->addCondition("totalPrice>=:p_s "); 
			$obj_criteria->params[':p_s']= $int_price_start;
			$arr_search['p_s'] = $int_price_start;
		}
		if (!empty($date_distribe_end) && $date_distribe_end!=''){
			$obj_criteria->addCondition("totalPrice<=:p_e "); 
			$obj_criteria->params[':p_e']= $int_price_end;
			$arr_search['p_e'] = $int_price_end;
		}
		
		$arr_search['ac'] = '';
		$str_account = $obj_request->getParam('ac');
		if (!empty($str_account) && $str_account!=''){
			$obj_criteria->addCondition("account like :ac "); 
			$obj_criteria->params[':ac']= '%'.$str_account.'%';
			$arr_search['ac'] = $str_account;
		}
		
		$arr_search['sou'] = '';
		$int_source = $obj_request->getParam('sou');
		if (!empty($int_source) && $int_source!=0){
			$obj_criteria->addCondition("source = :sou "); 
			$obj_criteria->params[':sou']= $int_source;
			$arr_search['sou'] = $int_source;
		}
		
		$arr_search['tp'] = '';
		$int_type = $obj_request->getParam('tp');
		if (!empty($int_type) && $int_type!=0){
			$obj_criteria->addCondition("type = :tp "); 
			$obj_criteria->params[':tp']= $int_type;
			$arr_search['tp'] = $int_type;
		}
		
		$arr_search['st'] = '';
		$int_status = $obj_request->getParam('st');
		if (!empty($int_status) && $int_status!=''){
			$obj_criteria->addCondition("status = :st "); 
			$obj_criteria->params[':st']= $int_status;
			$arr_search['st'] = $int_status;
		}
		
		$arr_search['dv'] = '';
		$int_distributor = $obj_request->getParam('dv');
		if (!empty($int_distributor) && $int_distributor!=''){
			$obj_criteria->addCondition("distributorId = :dv "); 
			$obj_criteria->params[':dv']= $int_distributor;
			$arr_search['dv'] = $int_distributor;
		}
		
		$model_order = new Order();
        $int_count = $model_order->count($obj_criteria);
        $pager = new CPagination($int_count);
        $pager->pageSize = $int_page_size;
        $pager->setCurrentPage($int_page-1);
        $pager->applyLimit($obj_criteria);
        $obj_list = $model_order->findAll($obj_criteria);
		//print_r($list);
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => $int_count,
		);
		$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_page_param'=>$arr_page_param
							,'obj_list'=>$obj_list
							,'arr_source'=>Yii::app()->params['order_source']
							,'arr_status'=>Yii::app()->params['order_status']
							,'arr_type'=>Yii::app()->params['order_type']
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
			$nouser = $request->getParam('nouser');
	  		$arr_ids = $request->getParam('ids');
	  		$arr_name = $request->getParam('name');
	  		$arr_price = $request->getParam('price');
	  		$arr_order_number = $request->getParam('order_number');
	  		
	  		if ($nouser==1){//无用户
	  			
	  			
	  		}else{//查到当前用户
		  		$datas = array(
		  			'order_date'       => trim($request->getParam('order_date')),
		  			'account'          => trim($request->getParam('account')),
		  			'address_id'	   => trim($request->getParam('address_id')),
		  		    'source'	       => trim($request->getParam('source')),
		  		 	'remark'	       => trim($request->getParam('remark')),
		  			'arr_ids'          => $arr_ids,
		  			'arr_name'         => $arr_name,
		  			'arr_price'        => $arr_price,
				    'arr_order_number' => $arr_order_number
		  		);
		   		
		  		if(empty($datas)){
		  			return false;
		  		}
		  		$transaction = Yii::app()->db->beginTransaction();
		  		
				try{
					Yii::import('application.modules.user.models.Address');
					$obj_model_user = new Address();
					$obj_address = $obj_model_user->find(" id = :id ",array(':id'=>$datas['address_id']));
					if (!empty($obj_address)){
						$arr_address = $obj_address->attributes;
						$totel_price = 0;
						$totel_number = 0;
						for($i=0;$i<count($datas['arr_ids']);$i++){
							$totel_price = $totel_price + intval($datas['arr_price'][$i])*intval($datas['arr_order_number'][$i]);
							$totel_number = $totel_number + intval($datas['arr_order_number'][$i]);
						}
						//echo $totel_price;
						//exit;
						$obj_model_order = new Order();
						$obj_model_order->_attributes = array(
							'account' =>$datas['account'],
							'source'  =>$datas['source'],
							'orderDate' =>$datas['order_date'],
							'name' =>$arr_address['name'],
							'address' =>$arr_address['address'],
							'mobile' =>$arr_address['mobile'],
							'totalPrice' => $totel_price,
							'totalNumber' => $totel_number,
							'remark' => $arr_address['remark']
						);
						$obj_model_order->setIsNewRecord(true);
						if ($obj_model_order->insert()){
							$order_id = $obj_model_order->getPrimaryKey();
							
							$order_sn = $datas['order_date'].'001'.sprintf('%05d',$order_id);
							$obj_model_order->setIsNewRecord(false);
							$obj_model_order->_attributes = array(
								'sn'=>$order_sn
							);
							$obj_model_order->update();
							
							
							OrderLog::model()->add(array(
								'orderId' =>$order_id,
								'type' =>1,
								'operator' =>Yii::app()->user->name,
								'remark' =>'下单成功'
							));
							
							for($i=0;$i<count($datas['arr_ids']);$i++){
								$obj_model_orderdish = new OrderDish();
								$obj_model_orderdish ->_attributes = array(
										'orderId' =>$order_id,
										'dishId' =>$datas['arr_ids'][$i],
										'dishName' =>$datas['arr_name'][$i],
										'price' =>$datas['arr_price'][$i],
										'quantity' =>$datas['arr_order_number'][$i]
									);
								$obj_model_orderdish->setIsNewRecord(true);
								$obj_model_orderdish->insert();
								$transaction->commit();
							}
							$this->redirect(array('index'));
						}
					}
				}catch (Exception $re){
					$transaction->rollback();
					throw Exception($re);
				}
	  		}
  		
		}else{
			$date_now = date('Y-m-d');
			$obj_criteria=new CDbCriteria();
			
			//组合条件
			if (!empty($date_now) && $date_now!=''){
				$obj_criteria->addCondition("DATEDIFF(datename,:date_now)=0 "); 
				$obj_criteria->params[':date_now']= $date_now;
			}
			Yii::import('application.modules.default.models.Menu');
			Yii::import('application.modules.default.models.MenuDish');
			$model_menu = new Menu();
			$obj_menu = $model_menu->find($obj_criteria);
			if (!empty($obj_menu)){
				$int_menu_id = $obj_menu->attributes['id'];
				$obj_criteria=new CDbCriteria(array(
					'order'=>'orderBy DESC'
				));
				if (!empty($int_menu_id) && $int_menu_id!=''){
					$obj_criteria->addCondition("menuId=:id "); 
					$obj_criteria->params[':id']= $int_menu_id;
				}
				$model_menu = new MenuDish();
				$obj_dish_list = $model_menu->findAll($obj_criteria);
			}else{
				$obj_dish_list = null;
			}
			//print_r($obj_dish_list);
			$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'obj_dish_list'=>$obj_dish_list
							,'arr_source'=>Yii::app()->params['order_source']
							);
			
			$this->render('add',$arr_render);
		}
	}
	
	public function actionEdit(){
		
		
	}
	
	public function actionDetail(){
		
		$request = Yii::app()->getRequest();
  	    $id = trim($request->getParam("id"));
  	    
  	    $obj_model_order = new Order();
  	    $obj_model_orderlog = new OrderLog();
  	    $obj_order = $obj_model_order->find('id=:id',array(':id'=>$id));
		if(!empty($_POST)){
			$distributorId = trim($request->getParam("distributorId"));
			$obj_order->_attributes = array(
				'status' => 2,
				'distributorId' => $distributorId
			);
			$obj_order->setIsNewRecord(false);
			$obj_order->update();
			$obj_model_orderlog->add(array(
				'orderId' =>$id,
				'type' =>2,
				'operator' =>Yii::app()->user->name,
				'remark' =>'订单发货'
			));
		}
		try{
			
			$obj_model_orderdish = new OrderDish();
			$obj_order_dishs = $obj_model_orderdish->findAll('orderId=:id',array(':id'=>$id));
			
			$arr_distributors = array();
			if($obj_order->attributes['status']==0){//选择配送员
				$obj_model_distributor = new Distributor();
				$arr_distributors = $obj_model_distributor->getDistributor($obj_order['orderDate']);
			}
			
			//得到操作日志
			$obj_loglist = $obj_model_orderlog->findAll('orderId = :id ' ,array(':id'=>$id));
			
			$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_order' => $obj_order->attributes
							,'obj_order_dishs'  => $obj_order_dishs
							,'arr_distributors' => $arr_distributors
							,'obj_loglist' => $obj_loglist
							);
			
			$this->render('detail',$arr_render);
		}catch(Exception $e){
			throw Exception($e);
		}
		
	}
	
	public function actionSuccess(){
		$request = Yii::app()->getRequest();
  	    $id = trim($request->getParam("id"));
  	    
  	    $obj_model_order = new Order();
		
		$obj_order = $obj_model_order->find('id=:id',array(':id'=>$id));
		$obj_order->_attributes = array(
			'status' => 3
		);
		$obj_order->setIsNewRecord(false);
		$obj_order->update();
		OrderLog::model()->add(array(
				'orderId' =>$id,
				'type' =>3,
				'operator' =>Yii::app()->user->name,
				'remark' =>'订单配送成功'
			));
		$this->redirect(array('/order/default/detail?id='.$id));
	}
	
	public function actionCancel(){
		
		$request = Yii::app()->getRequest();
  	    $id = trim($request->getParam("id"));
  	    
  	    $obj_model_order = new Order();
		
		$obj_order = $obj_model_order->find('id=:id',array(':id'=>$id));
		$obj_order->_attributes = array(
			'status' => 5
			//,'distributorId' => $distributorId
		);
		$obj_order->setIsNewRecord(false);
		$obj_order->update();
		OrderLog::model()->add(array(
				'orderId' =>$id,
				'type' =>5,
				'operator' =>Yii::app()->user->name,
				'remark' =>'订单取消'
			));
		$this->redirect(array('index'));
	}
	
	public function actionfaild(){
		
		$request = Yii::app()->getRequest();
  	    $id = trim($request->getParam("id"));
  	    
  	    $obj_model_order = new Order();
		
		$obj_order = $obj_model_order->find('id=:id',array(':id'=>$id));
		$obj_order->_attributes = array(
			'status' => 4
			//,'distributorId' => $distributorId
		);
		$obj_order->setIsNewRecord(false);
		$obj_order->update();
		OrderLog::model()->add(array(
				'orderId' =>$id,
				'type' =>4,
				'operator' =>Yii::app()->user->name,
				'remark' =>'订单异常'
			));
		$this->redirect(array('index'));
	}
}