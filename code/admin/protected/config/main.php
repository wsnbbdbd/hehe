<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'测试',
	//'language'=>'zh_cn',  //此处根据你拷贝文件夹名自行设置  
    //'charset'=>'utf8',  //设置网站字符编码  
	// preloading 'log' component
	'preload'=>array('log'),
	
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.PHPExcel.*',
		'application.extensions.upload.*',
		'application.extensions.yii-pdf.*'
	),
	'modules'=>array(
		'default',
		'user',
		'order'
	),
	'defaultController'=>'default',

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'loginUrl'=>array('/user/auth/index')
		),
		'curl' => array(
            'class' => 'application.extensions.curl.Curl',
            'options' => array()
        ),
		'ePdf' => array(
	        'class'         => 'ext.yii-pdf.EYiiPdf',
	        'params'        => array(
	            'mpdf'     => array(
	                'librarySourcePath' => 'application.vendors.mpdf.*',
	                'constants'         => array(
	                    '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
	                ),
	                'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
	                /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
	                    'mode'              => '', //  This parameter specifies the mode of the new document.
	                    'format'            => 'A4', // format A4, A5, ...
	                    'default_font_size' => 0, // Sets the default document font size in points (pt)
	                    'default_font'      => '', // Sets the default font-family for the new document.
	                    'mgl'               => 15, // margin_left. Sets the page margins for the new document.
	                    'mgr'               => 15, // margin_right
	                    'mgt'               => 16, // margin_top
	                    'mgb'               => 16, // margin_bottom
	                    'mgh'               => 9, // margin_header
	                    'mgf'               => 9, // margin_footer
	                    'orientation'       => 'P', // landscape or portrait orientation
	                )*/
	            ),
	            'HTML2PDF' => array(
	                'librarySourcePath' => 'application.vendors.html2pdf.*',
	                'classFile'         => 'html2pdf.class.php', // For adding to Yii::$classMap
	                /*'defaultParams'     => array( // More info: http://wiki.spipu.net/doku.php?id=html2pdf:en:v4:accueil
	                    'orientation' => 'P', // landscape or portrait orientation
	                    'format'      => 'A4', // format A4, A5, ...
	                    'language'    => 'en', // language: fr, en, it ...
	                    'unicode'     => true, // TRUE means clustering the input text IS unicode (default = true)
	                    'encoding'    => 'UTF-8', // charset encoding; Default is UTF-8
	                    'marges'      => array(5, 5, 5, 8), // margins by default, in order (left, top, right, bottom)
	                )*/
	            )
	        ),
	    ),
		// uncomment the following to use a SQLITE database
		/*
		'db'=>array(
			'connectionString' => 'sqlite:protected/data/blog.db',
			'tablePrefix' => 'tbl_',
		),
		*/
		// uncomment the following to use a MySQL database
		'db'=>require(dirname(__FILE__).'/database.php'),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'/error/error',
        ),
        'urlManager'=>array(
        	'urlFormat'=>'path', 
        	'showScriptName' => false,
        	//'caseSensitive' => false,//设置不区分大小写
        	'rules'=>array(  //ngnix使用
			    '<controller:\w+>/<id:\d+>'=>'<controller>/view',  
			    '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',  
			    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',  
			),
			//'urlSuffix' => '.html', //后缀  
        ),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				array(
					'class'=>'CWebLogRoute',
				),
				
			),
		),
		/*'cache'=>array(  
            'class'=>'CMemCache',  
              'servers'=>array(  
                array(  
                    'host'=>'127.0.0.1',  
                    'port'=>11211,  
                    //'weight'=>60, //当要使用多个cache轮询时，可以给每个cache配权重(weight)。如果只有一个cache，不加这个配置就可以了。
                ), */
                /*array(  
                    'host'=>'172.28.102.3',  
                    'port'=>11211,  
                    'weight'=>40,  
                ),*/
          /*  ),   
        ),
        //设置session存储在memcached
       'session' => array (
            'class'=> 'CCacheHttpSession',
            'cacheID' => 'cache',
            //'autoStart' => true,
            'cookieMode' => 'only',
            'timeout' => 1200,
        ),*/
     ),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>require(dirname(__FILE__).'/params.php'),
);

?>