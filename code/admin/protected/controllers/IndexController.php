<?php

class IndexController extends CController {
	public $layout = 'main';
	
	public function actionIndex(){
	    $this->render('index');
	}
	public function actionSearch(){
		$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$pagesize = 20;
		
		
		//$response = XSpace_Content::advancedSearch('',$page,$pagesize);
		$response = XSpace_Content::search('',$page,$pagesize);
		print_r($response);
		exit;
		
		XSpace_Content::getEntityModel('461A00E4F4FD43b8822A33812C1B27A1','Clip');
		
		//XSpace_Content::getEntityModel('98c5f99a-ca92-40d7-a9d1-383aa20ab671','Picture');
	}
	
	/*
	 * 生成PDF示例
	 */
	public function actionPdf(){
		
		# mPDF
       /*$mPDF1 = Yii::app()->ePdf->mpdf();
 
        # You can easily override default constructor's params
        $mPDF1 = Yii::app()->ePdf->mpdf('', 'A5');
 
        # render (full page)
        $mPDF1->WriteHTML($this->render('index', array(), true));
 
        # Load a stylesheet
        //$stylesheet = file_get_contents(Yii::getPathOfAlias('webroot.css') . '/main.css');
        //$mPDF1->WriteHTML($stylesheet, 1);
 
        # renderPartial (only 'view' of current controller)
        //$mPDF1->WriteHTML($this->renderPartial('index', array(), true));
 
        # Renders image
        //$mPDF1->WriteHTML(CHtml::image(Yii::getPathOfAlias('webroot.css') . '/bg.gif' ));
 
        # Outputs ready PDF
        $mPDF1->Output();
        exit;*/
 
        ////////////////////////////////////////////////////////////////////////////////////
 		
		/*$info = $this->render('index', array('test'=>'12312312312'),true);
		echo $info;
		exit;*/
		
		
        # HTML2PDF has very similar syntax
        $html2pdf = Yii::app()->ePdf->HTML2PDF();
        $html2pdf->WriteHTML($this->renderPartial('index', array('test'=>'12312312312'), true));
        $html2pdf->Output();
        //$html2pdf->Output('1.pdf', EYiiPdf::OUTPUT_TO_DOWNLOAD);
 		exit;
        ////////////////////////////////////////////////////////////////////////////////////
 
        # Example from HTML2PDF wiki: Send PDF by email
        /*$content_PDF = $html2pdf->Output('', EYiiPdf::OUTPUT_TO_STRING);
        require_once(dirname(__FILE__).'/pjmail/pjmail.class.php');
        $mail = new PJmail();
        $mail->setAllFrom('webmaster@my_site.net', "My personal site");
        $mail->addrecipient('mail_user@my_site.net');
        $mail->addsubject("Example sending PDF");
        $mail->text = "This is an example of sending a PDF file";
        $mail->addbinattachement("my_document.pdf", $content_PDF);
        $res = $mail->sendmail();*/
	}
	
	/*
	 * session存储在memcached中
	 */
	public function actionSess(){
		/*session_start();
		if (!isset($_SESSION['TEST'])) {
			$_SESSION['TEST'] = time();
		}
		$_SESSION['TEST3'] = time();
		print $_SESSION['TEST'];
		print "<br><br>";
		print $_SESSION['TEST3'];
		print "<br><br>";
		print session_id();*/
		/*session_start();
		$mem = new Memcache();
		$mem->addServer("127.0.0.1",11211)or die ("Could not add server 11211");  
		//$mem->set("ikcod9q3vnju87hh911917t832",''); 
		$val = $mem->get("ikcod9q3vnju87hh911917t832");
		
		echo $val;*/
	}
	public function actionGetsess(){
		Yii::app()->session['username']='test';
		//echo Yii::app()->session->sessionID;
		//echo Yii::app()->session['username'];
		//session_start();
		//print_r($_SESSION['TEST']);
		/*var_dump(Yii::app()->cache);
		var_dump(Yii::app()->cache->get('ikcod9q3vnju87hh911917t832'));*/
		
		
		/*
         * 得到sessionID号
         * 计算出来存在memcached的key值是多少.
         */
        $sessionId = Yii::app()->session->sessionID;
        echo "key:", $key = CCacheHttpSession::CACHE_KEY_PREFIX.$sessionId;
         
        /**
         * 这相当于是直接使用Memcached 连接，和session没有任何挂钩，
         * 我们来看一下session的数据是否真的就存在了memcached里边。
         * 通过计算出来的key直接用 get命令获取然后将数据打印出来就能看到值了。
         * 测试的时候先登录噢，别不登录就开始测试估计会获取不到值，以为有问题呢！
         */
        $mem =  Yii::app()->cache;
        $data =$mem->get($key);
        var_dump($data);
	}
	
	public function actionPages(){
		$obj_request = Yii::app()->getRequest();
		$int_page = $obj_request->getParam('page');
		$int_page = !empty($int_page) ? intval($int_page) : 1;
		$int_page_size = 10;
		
		$arr_page_param = array(
			'int_current_page' => $int_page,
			'int_page_size' => $int_page_size,
			'int_item_count' => 100,
			//'int_url_type' => 1,
			//'str_page_var' => 'p'
			//'int_show_num' => 5,
			//'str_class' => 'page-box'
		);
	
		//var_dump(Yii::app()->urlManager);
		//echo Yii::app()->urlManager->urlSuffix;
		//exit;
	    
	    $this->render('page',array('r'=>Yii::app()->request->baseUrl.'/','arr_page_param'=>$arr_page_param));
		
	}
	
	public function actionCurl(){
		$url='http://www.baidu.com';
		$params = array();
		$output = Yii::app()->curl->get($url, $params);
		var_dump($output);
	}
}