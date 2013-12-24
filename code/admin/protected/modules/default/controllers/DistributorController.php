<?php
class DistributorController extends Controller {
	
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
		/*
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
		*/
		
		
		$model_distributor = new Distributor();
        $int_count = $model_distributor->count($obj_criteria);
        $pager = new CPagination($int_count);
        $pager->pageSize = $int_page_size;
        $pager->setCurrentPage($int_page-1);
        $pager->applyLimit($obj_criteria);
        $obj_list = $model_distributor->findAll($obj_criteria);
		//print_r($obj_list);
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => $int_count,
		);
		$arr_render = array('r'=>Yii::app()->request->baseUrl.'/'
							,'arr_page_param'=>$arr_page_param
							,'obj_list'=>$obj_list
							);
		
		$this->render('index',$arr_render);
	}
}