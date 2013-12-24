<?php 
/**
 * 公用头部
 * 
 * @author zhaozhe
 * @date 2013-11-13
 * @version 1.0
 */
	
class Header extends CWidget {
   public function init()
   {
	   parent::init();
   }

   public function run() {
   		$this->render('header');
   }
  
}

?>
