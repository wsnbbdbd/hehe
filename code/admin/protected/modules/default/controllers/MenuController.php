<?php
class MenuController extends Controller {
	
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
		$model_menu = new Menu();
        $int_count = $model_menu->count($obj_criteria);
        $pager = new CPagination($int_count);
        $pager->pageSize = $int_page_size;
        $pager->setCurrentPage($int_page-1);
        $pager->applyLimit($obj_criteria);
        $obj_list = $model_menu->findAll($obj_criteria);
		//print_r($list);
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => $int_count,
		);
		$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_page_param'=>$arr_page_param
							,'obj_list'=>$obj_list);
		
		$this->render('index',$arr_render);
	}
	
	/*
	 * 添加
	 */
	public function actionAdd(){
		$request = Yii::app()->getRequest();
		if(!empty($_POST)){
	  		$arr_ids = $request->getParam('ids');
	  		$arr_name = $request->getParam('name');
	  		$arr_price = $request->getParam('price');
	  		$arr_reverse = $request->getParam('reverse');
	  		$arr_menu_date[] = $request->getParam('date_from');
	  		$arr_menu_date[] = $request->getParam('date_to');
	  		
	  		$datas = array(
	  			'menu_date'    => $arr_menu_date,
	  			'ids'       => $arr_ids,
	  			'name'       => $arr_name,
	  			'price'       => $arr_price,
			    'reverse'       => $arr_reverse
	  		);
	   		
	  		//print_r($datas);
	  		//exit;
	  		if(empty($datas)){
	  			return false;
	  		}
			//try{
				$days = (strtotime($datas['menu_date'][1])-strtotime($datas['menu_date'][0]))/86400;
				
				$obj_model_menu = new Menu();
				if ($days==0){
					
					$obj_model_menu->_attributes = array(
						'datename' =>$datas['menu_date'][0],
						'status' => 1
					);
					$obj_model_menu->setIsNewRecord(true);
					if ($obj_model_menu->insert()){
						$arr_data = array(
							'menu_id' => $obj_model_menu->getPrimaryKey(),
							'dishs'	=> $datas
						);
						self::bindDish($arr_data);
						//$this->showTip('成功','数据提交成功');
					}else{
						//$this->showTip('失败','请稍候重试','error');
					}
				}else{
					for($int_i=0;$int_i<=$days;$int_i++){
						$temp_date = $datas['menu_date'][0];
						$menu_date =  date('Y-m-d',strtotime("$temp_date +$int_i day"));
						
						$obj_model_menu->_attributes = array(
							'datename' =>$menu_date,
							'status' => 1
						);
						$obj_model_menu->setIsNewRecord(true);
						if ($obj_model_menu->insert()){
							$arr_data = array(
								'menu_id' => $obj_model_menu->getPrimaryKey(),
								'dishs'	=> $datas
							);
							self::bindDish($arr_data);
							//$this->showTip('成功','数据提交成功');
						}else{
							//$this->showTip('失败','请稍候重试','error');
						}
					}
				}
				$this->redirect(array('index'));
			/*}catch (Exception $re){
				throw Exception($re);
			}*/
  		
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
		
		$obj_model_menu = new Menu();
		$obj_model_menudish = new MenuDish();
		try{
			$obj_menu = $obj_model_menu->find('id=:id',array(':id'=>$id));
			$obj_menudishs = $obj_model_menudish->findAll('menuId=:id',array(':id'=>$id));
		}catch(Exception $e){
			throw Exception($e);
		}
		
		if(!empty($_POST)){
	  		
	  		$arr_ids = $_POST['ids'];
	  		$arr_name = $_POST['name'];
	  		$arr_price = $_POST['price'];
	  		$arr_reverse = $_POST['reverse'];
	  		
	  		$datas = array(
	  			'menu_date'    => trim($request->getParam('menu_date')),
	  			'ids'       => $arr_ids,
	  			'name'       => $arr_name,
	  			'price'       => $arr_price,
			    'reverse'       => $arr_reverse
	  		);
	   		
	  		//print_r($datas);
	  		//exit;
	  		if(empty($datas)){
	  			return false;
	  		}
			//try{
				
				$obj_model_menu->_attributes = array(
					'datename' =>$datas['menu_date'],
					'status' => 1
				);
				$obj_model_menu->setIsNewRecord(false);
				
				if ($obj_model_menu->update()){
					$obj_model_menudish->deleteAll('menuId=:id',array(':id'=>$id));
					$arr_data = array(
						'menu_id' => $id,
						'dishs'	=> $datas
					);
					self::bindDish($arr_data);
					//$this->showTip('成功','数据提交成功');
				}else{
					//$this->showTip('失败','请稍候重试','error');
				}
				$this->redirect(array('index'));
			/*}catch (Exception $re){
				throw Exception($re);
			}*/
  			
		}else{
			
			$this->render('edit',array('r'=>Yii::app()->request->baseUrl.'/','datas' => $obj_menu,'menudishs'=>$obj_menudishs));
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
				$obj_model_menu = new Menu();
				$obj_menu = $obj_model_menu->find('id=:id',array(':id'=>$id));
				$obj_menu->delete();
				
				$obj_model_menudish = new MenuDish();
				$obj_model_menudish->deleteAll('menuId=:id',array(':id'=>$id));
				
				$this->redirect(array('index'));
			}catch (Exception $e){
				throw Exception($e);
			}
		}
	}
	
	/**
  	 * ajax方法
  	 */
	public function actionAjax(){
		$obj_request = Yii::app()->getRequest();
		$action = trim($obj_request->getParam("action"));
		switch ($action){
			case 'getDate':
				$dt_start = $obj_request->getParam("d_s");
				$dt_end = $obj_request->getParam("d_e");
				$obj_model_menu = new Menu();
				$obj_menu = $obj_model_menu->findAll('DATEDIFF(datename,:d_s)>=0 AND DATEDIFF(datename,:d_e)<=0 ',array(':d_s'=>$dt_start,':d_e'=>$dt_end));
				if ($obj_menu){
					exit('false');
				}else{
					exit('true');
				}
				break;
				
		}
	}
	
	private function bindDish($arr_data){
		if (!empty($arr_data)){
			$menu_id = $arr_data['menu_id'];
			$dishs = $arr_data['dishs'];
			if (!empty($dishs['ids'])){
				$_length = count($dishs['ids']);
				for ($i=0;$i<$_length;$i++){
					$arr_param = array(
						'menuId' => $menu_id,
						'dishId' => $dishs['ids'][$i],
						'dishName' => $dishs['name'][$i],
						'price' => $dishs['price'][$i],
						'stock' => $dishs['reverse'][$i],
						'orderBy' => $i+1
					);
					$obj_model_menudish = new MenuDish();
					
					$obj_model_menudish->_attributes = $arr_param;
					$obj_model_menudish->setIsNewRecord(true);
					$obj_model_menudish->insert();
				}
			}
		}
	}
	
}