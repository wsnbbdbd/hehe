<?php
class Dishimage extends CActiveRecord {
	
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
		return '{{DishImage}}';
	}
	
	/*public function relations()  
    {  
        return array(  
            'image'=>array(self::BELONGS_TO, 'Dish', 'dishId'),  
        );  
    }*/ 
	
}