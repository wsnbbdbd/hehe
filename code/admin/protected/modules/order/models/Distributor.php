<?php
class Distributor extends CActiveRecord {
	
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
		return '{{Distributor}}';
	}
	
	public function getDistributor($date){
		$sql = 'SELECT D.id,name,IFNULL(O.orderNumber,0) AS orderNumber FROM tb_Distributor D 
				LEFT JOIN (SELECT distributorId,COUNT(id) AS orderNumber FROM tb_Order 
				WHERE `status`=1 AND DATEDIFF(orderDate,:date)=0 
				GROUP BY distributorId ) O ON D.id=O.distributorId;';
		$command = Yii::app()->db->createCommand($sql);
		$command->bindParam(':date', $date);  
		$arr_return = $command->queryAll();
		return $arr_return;
	}
}