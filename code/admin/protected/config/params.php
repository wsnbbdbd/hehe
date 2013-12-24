<?php

// 通用配置信息
return array(
	
	'title'=>'综合业务管理系统',
	//中心服务器webservice的地址
	'xspace_webservice' => array(
		'sub_scription' => 'http://172.28.102.11:8080/SobeyDCMP/services/subScriptionRuleWebService?wsdl',
		//'content' => 'http://172.20.22.3:8080/SobeyDCMP/services/XDAContentAcquireService?wsdl',
		//'content' => 'http://172.28.102.41:8080/SobeyDCMP/services/XDAContentAcquireService?wsdl',		
		'content' => 'http://172.28.102.11:8080/SobeyDCMP/services/XDAContentAcquireService?wsdl',
		'fiflow' => 'http://172.28.102.11:8080/SobeyDCMP/services/FiFlowInstanceService?wsdl'
	),
	'xspace_param' => array(
		'contenttype' => array(
							2=>array('code'=>'Clip','name'=>'视频素材')
							,3=>array('code'=>'Picture','name'=>'图片素材')
							,4=>array('code'=>'Document','name'=>'')
							,5=>array('code'=>'Story','name'=>'')
							,7=>array('code'=>'Other','name'=>'')
							,8=>array('code'=>'Audio','name'=>'音频素材')
							,9=>array('code'=>'Flash','name'=>'')
							,10=>array('code'=>'DataSet','name'=>'成片剧集')
						),
		'xspace_status'=>array(0=>'在线',1=>'进线',2=>'离线',-5=>'未知')
	),
	
	'stream_media_http_path'=>'http://video.mgmall.com/P/',
	//'streamMediaHttpPath'=>'http://gmediamall.sobeycache.com/p/',//流媒体服务器地址
	//'streamMediaHttpPath'=>'http://test.xspace.com/p/',//流媒体服务器地址
	//'streamMediaHttpPath'=>'http://chengdushengchan.xspace.com/p/' ,//流媒体服务器地址
	
	
	'imgserver'=>'http://image.mgmall.com/keyframe/', //图片服务器地址
	//'imgserver'=>'http://172.28.102.4:8080/' //图片服务器地址
	//'imgserver'=>'http://172.20.22.6:8080/' //图片服务器地址
	//'imgserver'=>'http://172.28.102.43:8080/keyframe/'
	
	//订单渠道（来源）
	'order_source'=>array(
		1=>'电话',
		2=>'微信',
		3=>'网站',
		4=>'IM',
		5=>'集体单'
	),
	//订单操作
	'order_opration_type'=>array(
		1=>'创建订单',
		2=>'订单发货',
		3=>'订单完成',
		4=>'订单异常',
		5=>'取消订单'
	),
	//订单类型
	'order_type'=>array(
		1=>'标准',
		2=>'特价',
		3=>'兑换'
	),
	//订单状态
	'order_status'=>array(
		1=>'下单成功',
		2=>'配送中',
		3=>'订单成功',
		4=>'订单异常',
		5=>'取消订单'
	),
	//菜品类型
	'dish_type'=>array(
		1=>'套餐',
		2=>'饮料',
		3=>'小食',
		4=>'礼品'
	),
	//地址类型
	'address_type'=>array(
		1=>'公司',
		2=>'家里'
	),
);

?>
