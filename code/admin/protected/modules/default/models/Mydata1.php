<?php
class Mydata1  {
	
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	
	public function getMyName(){
		$my_name = 'good good study,day day upasdfasdf!';
		return $my_name;
	}
}