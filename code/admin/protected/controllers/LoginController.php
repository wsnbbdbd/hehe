<?php
class LoginController extends CController {
	
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
		
	}
	
}