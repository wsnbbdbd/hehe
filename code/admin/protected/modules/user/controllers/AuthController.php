<?php
class AuthController extends CController {
	
	public $layout = false;
	
	/*
	 * 登录表单页面
	 */
	public function actionIndex(){
	    $this->render('index');
	}
	/*
	 * 登录操作页面
	 */
	public function actionLogin(){
		$str_name = "";
		$msgError = "";
		
		if(!empty($_POST)) {
			$str_name = trim($_POST['username']);
			$str_password = trim($_POST['password']);
			if($str_name == ""){
				$msgError = "请输入用户名";
			}
			if($msgError == ""){
				if($str_password == ""){
					$msgError = "请输入密码";
				}
			}
			if($msgError == ""){
				$identity=new UserIdentity($str_name,md5($str_password));
				if($identity->authenticate()) {
					Yii::app()->user->login($identity);
					//$this->redirect(Yii::app()->user->returnUrl);
					if (strstr(Yii::app()->user->returnUrl,'favicon.ico')){
						$this->redirect(array('/default'));
					}else{
						$this->redirect(Yii::app()->user->returnUrl);
					}
					
				}else{
					$msgError = "用户名或密码错误";
				}
			}
		}
		$this->render('index', array(
			'username'=>$str_name,
			'msgError'=>$msgError
		));
	}
	
	public function actionLogout(){
		//删除权限缓存
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->user->returnUrl);
	}
}