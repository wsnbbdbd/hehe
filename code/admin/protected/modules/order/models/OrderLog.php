<?php
class OrderLog extends CActiveRecord {
	
/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{OrderLog}}';
	}
	
	public function add($datas){
		/*$this->_attributes = array(
				'orderId' =>$datas['orderId'],
				'type' =>$datas['type'],
				'operator' =>$datas['operator'],
				'remark' =>$datas['remark']
			);*/
		$this->_attributes = $datas;
		$this->setIsNewRecord(true);
		$this->insert();
		return $this->getPrimaryKey();
	}
	
	
}