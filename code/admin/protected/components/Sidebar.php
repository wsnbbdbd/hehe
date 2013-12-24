<?php 
/**
 * 侧边栏公共部件
 * 
 * @author     yjzzj.com 
 * @date       2012-08-16 
 * @version    1.3 
 */
	
class Sidebar extends CWidget {
   private $permissions;

   public function init()
   {
	   //$this->permissions = $this->permissionlist();
	   parent::init();
   }

   public function run() {
	  /* $controller = Yii::app()->getController()->id;
	   $this->render('sidebar',array(
		     'permissions' => $this->permissions,
		     'controller' =>$controller
	   ));*/
		$this->render('sidebar');
   }
   
   public function permissionlist()
   {
   		/*$model = new RolePermission();
	    $list = $model->getPermissionTree(Yii::app()->session['rid']);
	    return $list ;*/
   }
  
}

?>
