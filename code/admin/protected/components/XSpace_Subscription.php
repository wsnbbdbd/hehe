<?php
/*
 * xspace订阅规则接口
 */
class XSpace_Subscription
{
		
	/*
	 * 获取中心信息库的订阅规则
	 */
	public static function getAllRule(){
		$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
		$soap = new SoapClient($webServiceUrl);
		$response = $soap->getAllSubscriptionRuleCondition();
		return $response;
	}
	/*
	 * 创建客户订阅规则接口
	 */
	public static function addSubscription($orderInfo){
		$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
		$params->requestString = $orderInfo;
		$soap = new SoapClient($webServiceUrl);
		$response = $soap->addSubscriptionRule($params);
		if(is_object($response)){
        	$xmlobj = simplexml_load_string($response->return);
        	$return_array = array(
        		'subscriptionRuleId' => $xmlobj->subscriptionRuleId,
				'subscriptionResult' => $xmlobj->result,
				'subscriptionMessage' => $xmlobj->message
        	);
		}else{
			$return_array = array(
        		'subscriptionRuleId' => '',
				'subscriptionResult' => -2,
				'subscriptionMessage' => '接口无返回信息'
        	);
		}
		return $return_array;
	}
	
	/*
	 * 取消客户订阅规则接口
	 */
	public static function deleteSubscriptionRule($subscriptionRuleId){
		$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
		//print_r(self::cancelXmlCreate($subscriptionRuleId));
		//exit;
		$params->requestString = self::cancelXmlCreate($subscriptionRuleId);
		$soap = new SoapClient($webServiceUrl);
		$response = $soap->deleteSubscriptionRule($params);
		if(is_object($response)){
        	$xmlobj = simplexml_load_string($response->return);
        	//$xmlobj = (array)$xmlobj;
        	$return_array = array(
        		'subscriptionRuleId' => (string)$xmlobj->subscriptionRuleId,
				'subscriptionResult' => intval($xmlobj->result),
				'subscriptionMessage' => (string)$xmlobj->message
        	);
		}else{
			$return_array = array(
        		'subscriptionRuleId' => '',
				'subscriptionResult' => -2,
				'subscriptionMessage' => '接口无返回信息'
        	);
		}
		return $return_array;
	}
	/*
	 * 订阅出库任务查询接口
	 */
	public static function getAllSubscriptionTask($order_id,$customerName='',$exportTimeBegin='',$exportTimeEnd='',$entityName='',$pushSatus=10000,$start=0,$size=10,$orderField='',$isDesc=0){
		$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
		try{
			//exit($order_id.' ');
			$filter_xml = self::getTaskXml($order_id,$customerName,$exportTimeBegin,$exportTimeEnd,$entityName,$pushSatus,$start,$size,$orderField,$isDesc);
			$params->requestString = $filter_xml;
			$soap = new SoapClient($webServiceUrl);
			$response = $soap->getAllSubscriptionTask($params);
			if(is_object($response)){
				$xmlobj = simplexml_load_string($response->return);
				//print_r($xmlobj);
				$list = array();
				$list['totalCount'] =intval($xmlobj->totalCount);
				if ($xmlobj->searchResult){
					foreach ($xmlobj->searchResult->children() as $node) 
					{
						$list['list'][] = (array)$node;
					}
				}
				return $list;
			}
		}catch(Exception $e){
			throw Exception($e);
		}
	}
	/*
	 * 查询可用转码模板名称接口
	 */
	public static function getTranscodeTemplateNames(){
		try{
			$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
			$soap = new SoapClient($webServiceUrl);
			$response = $soap->getTranscodeTemplateNames();
			if(is_object($response)){
				$xmlobj = simplexml_load_string($response->return);
				$array = array();
				if($xmlobj){
					foreach ($xmlobj->children() as $name => $node) {
						$array[] = trim((string)$node);
					} 
				}
				return $array;
			}
		}catch(Exception $e){
			throw Exception($e);
		}
	}
	/*
	 * 分类接口-根据父节点获取分类信息
	 * param code:分类的编号，如果是查询第一层分类，分类号为空，即不填分类号。
	 */
	public static function getCategorysByCode($code=''){
		//try{
			$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
			$soap = new SoapClient($webServiceUrl);
			$params->code = $code;
			$response = $soap->getCategorysByCode($params);
			if(is_object($response)){
				$xmlobj = simplexml_load_string($response->return);
				print_r($xmlobj);
				/*$array = array();
				if($xmlobj){
					foreach ($xmlobj->children() as $name => $node) {
						$array[] = trim((string)$node);
					} 
				}*/
				return $array;
			}
		/*}catch(Exception $e){
			throw Exception($e);
		}*/
	}
	
	/*
	 * 分类接口-得到全部的分类信息
	 */
	public static function getAllCategorys(){
		try{
			$webServiceUrl = Yii::app()->params['xSpaceWebService']['subScription'];
			$soap = new SoapClient($webServiceUrl);
			$response = $soap->getAllCategorys();
			if(is_object($response)){
				$xmlobj = simplexml_load_string($response->return);
				//print_r($xmlobj);
				$array = json_decode(json_encode($xmlobj),TRUE);
				
				return $array['Category'];
			}
		}catch(Exception $e){
			throw Exception($e);
		}
	}
	
	/*
	 * 生成查询推送任务xml信息
	 */
	
	public static function getTaskXml($orderNo,$customerName='',$exportTimeBegin='',$exportTimeEnd='',$entityName='',$pushSatus=10000,$start=0,$size=10,$orderField='',$isDesc=0){
		$string = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<GetAllSubscriptionTaskRequest>
</GetAllSubscriptionTaskRequest>
XML;
		$xml = simplexml_load_string($string);
		$xml->addChild('customerName',$customerName);//客户名称
		$xml->addChild('orderNo',$orderNo);//订单编号
		$xml->addChild('exportTimeBegin',$exportTimeBegin);//出库完成时间开始
		$xml->addChild('exportTimeEnd',$exportTimeEnd);//出库完成时间
		$xml->addChild('entityName',$entityName);//素材名称
		$xml->addChild('pushSatus',$pushSatus);//推送状态 -1失败 0运行中 1挂起 2结束如果查询所有 设为 ：10000
		$xml->addChild('start',$start);//分页，开始页（如果不分页传-1）
		$xml->addChild('size',$size);//分页，每页记录数（如果不分页传-1）
		$xml->addChild('orderField',$orderField);//排序字段
		$xml->addChild('isDesc',$isDesc);//是否降序 0否  1是
		
		return $xml->asXML();
	}
	public static function cancelXmlCreate($ruleIds){
		$string = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<SubscriptionRuleRequest>
</SubscriptionRuleRequest>
XML;
		$xml = simplexml_load_string($string);
		$xml->addChild('subscriptionRuleId',$ruleIds);//订阅规则ID
		
		return $xml->asXML();
	}
	
	/*
	 * 根据订单号创建对应的创建规则xml请求字符串
	 */
	public static function orderXmlCreate($order,$customer,$ftplist){
		
		$string = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<SubscriptionRuleRequest>
</SubscriptionRuleRequest>
XML;
		$xml = simplexml_load_string($string);
		if (!empty($order) && !empty($customer)){
			$xml->addChild('valitifyStartDate',$order['start_time']);//订阅开始时间
			$xml->addChild('valitifyEndDate',$order['end_time']);//订阅结束时间
			
			$targetInfo_xml = $xml->addChild('targetInfo');//添加客户信息
			$targetInfo_xml->addChild('customerId', $order['customer_id']);
			$targetInfo_xml->addChild('customerName', $customer['company_name']);
			$targetInfo_xml->addChild('orderNo', $order['order_id']);
			$targetInfo_xml->addChild('orderPackageName', $order['order_name']);
			$targetInfo_xml->addChild('orderContent', $order['order_remark']);
			
			//ftp 信息的添加(暂时不支持多个FTP)
			//$ftp_xml = $targetInfo_xml->addChild('targetFTP');
			if (!empty($ftplist) && is_array($ftplist)){
				foreach( $ftplist as $info){
					if ($info['ftp_host']!='' && !empty($info)){
						$ftp_xml = $targetInfo_xml->addChild('targetFTP',$info['ftp_host'].':'.$info['ftp_port'].'#@#'.$info['ftp_username'].'#@#'.$info['ftp_password']);
						/*$ftpnode_xml = $ftp_xml->addChild('FTPAccount');
						$ftpnode_xml->addChild('Hosts',$info['ftp_host']);
						$ftpnode_xml->addChild('UserName',$info['ftp_username']);
						$ftpnode_xml->addChild('Password',$info['ftp_password']);*/
					}
				}
			}
			//订阅推送接口定义变更增加转码模板名称和目标出库地址
			//$targetInfo_xml->addChild('transcodeFormat', $order['file_type']);
			$targetInfo_xml->addChild('targetPath', '/pbmstest/${day}/${year}-${month}/abcdefg-${entitytype}/${entityname}}/');
			return $xml;
		}
	}
	
	/*
	 * 根据商品信息生成对应的规则信息
	 */
	public static function goodXmlCreate($orderxml,$good){
		$_spaiter = '**';//多个分隔符号
		
		$goodxml = $orderxml->addChild('subscriptionRule');
		
		if (!empty($good['good_category'])){
			$rule1_xml = $goodxml->addChild('subscriptionRuleItem');
			$rule1_xml->addChild('ruleId','1');
			$rule1_xml->addChild('ruleRelation',self::ruleRelation($good['good_category'],$_spaiter));
			$rule1_xml->addChild('ruleValue',$good['good_category']);
		}
		//print_r($list);
		//得到商品包订阅地区
		if (!empty($good['good_region'])){
			$rule2_xml = $goodxml->addChild('subscriptionRuleItem');
			//$area = $this->goodArea($good_id,$_spaiter);
			$rule2_xml->addChild('ruleId','2');
			$rule2_xml->addChild('ruleRelation',self::ruleRelation($good['good_region'],$_spaiter));
			$rule2_xml->addChild('ruleValue',$good['good_region']);
		}
		
		//关键字信息
		if (!empty($good['good_keyword'])){
			$rule3_xml = $goodxml->addChild('subscriptionRuleItem');
			if (!empty($good['good_keyword']) && $good['good_keyword']!=''){
				$keywordlist = explode(',',$good['good_keyword']);
				//print_r(count($keywordlist));
				//exit;
				$rule3_xml->addChild('ruleId','3');
				$ruleRelation = 1;
				if (count($keywordlist)>1){
					$ruleRelation = 3;
				}
				$rule3_xml->addChild('ruleRelation',$ruleRelation);
				$rule3_xml->addChild('ruleValue',join($_spaiter,$keywordlist));
			}
		}
		//得到商品频道信息
		if (!empty($good['good_channel'])){
			$rule5_xml = $goodxml->addChild('subscriptionRuleItem');
			//$channel = $this->goodChannel($good['good_category'],$_spaiter);
			
			$rule5_xml->addChild('ruleId','5');
			$rule5_xml->addChild('ruleRelation',self::ruleRelation($good['good_channel'],$_spaiter));
			$rule5_xml->addChild('ruleValue',$good['good_channel']);
		}
		return array('xml'=>$orderxml,
					'category'=>$good['good_category'],
					'area'=>$good['good_region'],
					'channel'=>$good['good_channel']);
	}
	
	/*
	 * 对应的规则信息
	 */
	function ruleRelation($strinfo,$_spaiter){
		$arraylist = explode($_spaiter,$strinfo);
		$ruleRelation = 1;
		if(count($arraylist)>1){
			$ruleRelation = 3;
		}
		return $ruleRelation;
	}
	
	
	
}