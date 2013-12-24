<?php 
/**
 * 公共页面底部（默认）版面一
 * 
 * @author zhangyulong 
 * @date 2013-10-14 
 * @version 1.0
 */
	
class Footer extends CWidget {

   public function init()
   {
	   parent::init();
   }

   public function run() {
   		$this->render("footer");
   }
  
}

?>
