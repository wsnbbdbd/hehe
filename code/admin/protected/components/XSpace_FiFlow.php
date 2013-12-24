<?php
/*
 * xspace出库接口
 */
class XSpace_FiFlow
{
	/*
	 * 重新发起出库请求
	 */
	public static function batchRedirectProcess($str_procInstIds){
		//得到webservice地址
		$str_webServiceUrl = Yii::app()->params['xSpaceWebService']['fiflow'];
		try{
			$obj_params->procInstIds = $str_procInstIds;
			$obj_soap = new SoapClient($str_webServiceUrl);
			$obj_response = $obj_soap->batchRedirectProcess($obj_params);
			print_r($obj_response);
			exit;
			if(is_object($obj_response)){
				$obj_xml = simplexml_load_string($obj_response->return);
				print_r($obj_xml);
				exit;
			}
		}catch(Exception $e){
			throw Exception($e);
		}
	}
}