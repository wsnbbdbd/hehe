<?php
/*
 * xspace内容信息接口
 */
class XSpace_Content
{
	/*
	 * 内容实体信息模型化
	 */
	public static function getEntityModel($str_entity_id,$str_entity_type){	
		
		if (strtolower($str_entity_type)=='clip'){
			$arr_entity_info = self::getEntityVideo($str_entity_id,$str_entity_type);
			$goodmodel = new GoodVideoModel($arr_entity_info);
		}else if(strtolower($str_entity_type)=='picture'){
			$arr_entity_info = self::getEntityPicture($str_entity_id,$str_entity_type);
			$goodmodel = new GoodPictureModel($arr_entity_info);
		}
		//echo $str_entity_type;
		//print_r($arr_entity_info);
		//exit;
		//var_dump($goodmodel);
		return $goodmodel;
	}
	public function getEntityPicture($str_entity_id,$str_entity_type){
		$arr_entity_info = array();
		
		$arr_entitydata = array();
		$arr_metadata = array();
		$arr_file = array('low'=>'','high'=>'');
		
		$obj_xml_entity = self::getEntityDetailInfo($str_entity_id,$str_entity_type);
		//得到内容实体数据
		$obj_node_entity = $obj_xml_entity->getElementsByTagName("EntityData")->item(0);
		
		foreach ( $obj_node_entity->childNodes as $obj_node ) {
			$arr_entitydata[strtolower($obj_node->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_node->getElementsByTagName("Value")->item(0)->nodeValue;
		}
		
		$obj_metadata =  $obj_xml_entity->getElementsByTagName("Metadata")->item(0);
		
		//得到关键帧等 编目数据
		foreach ( $obj_metadata->childNodes as $obj_node ) {
			
			if ($obj_node->getElementsByTagName("TypeID")->item(0)->nodeValue == 'KEYFRAME'){//关键帧信息
				$obj_keyframe = $obj_node->getElementsByTagName("Attributes");
				foreach ( $obj_keyframe as $obj_attribute ){
					$arr_keyframe_node = array();
					if ($obj_attribute->hasChildNodes()){
						foreach ( $obj_attribute->childNodes as $obj_item ) {
							$arr_keyframe_node[strtolower($obj_item->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_item->getElementsByTagName("Value")->item(0)->nodeValue;
						}
					}
					$arr_metadata[strtolower('KEYFRAME')][] = $arr_keyframe_node;
				}
				
			}else if ($obj_node->getElementsByTagName("TypeID")->item(0)->nodeValue == 'CUSTOMCLIPMETADATA'){
				$obj_nodelist = $obj_node->getElementsByTagName("Item");
				$arr_custom_clip_metadata = array();
				foreach ( $obj_nodelist as $obj_item ) {
					$arr_custom_clip_metadata[strtolower($obj_item->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_item->getElementsByTagName("Value")->item(0)->nodeValue;
				}
				$arr_metadata[strtolower('CUSTOMCLIPMETADATA')]=$arr_custom_clip_metadata;
			}else{
				$obj_nodelist = $obj_node->getElementsByTagName("Item");
				$arr_custom_clip_metadata = array();
				foreach ( $obj_nodelist as $obj_item ) {
					$arr_custom_clip_metadata[strtolower($obj_item->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_item->getElementsByTagName("Value")->item(0)->nodeValue;
				}
				$arr_metadata[strtolower($obj_node->getElementsByTagName("TypeID")->item(0)->nodeValue)]=$arr_custom_clip_metadata;
			}
		}
		
		$arr_entity_info = array(
						'entitydata' =>$arr_entitydata,
						'metadata'=>$arr_metadata
					);
		
					
		//得到低码视频地址（等待处理）
		$obj_node_filedata = $obj_xml_entity->getElementsByTagName("FileData")->item(0);
		foreach ( $obj_node_filedata->childNodes as $obj_file ) {
			//var_dump($obj_file);
			if ($obj_file->getElementsByTagName("QualityType")->item(0)->nodeValue==1){//低码文件
				$file = $obj_file->getElementsByTagName("Instance")->item(0);
				$arr_file['low'] = $file->getElementsByTagName("FullPath")->item(0)->nodeValue;
			}
			if ($obj_file->getElementsByTagName("QualityType")->item(0)->nodeValue==0){//高码文件
				 $file = $obj_file->getElementsByTagName("Instance")->item(0);
				 $arr_file['high'] = $file->getElementsByTagName("FullPath")->item(0)->nodeValue;
			}
		}
		$arr_entity_info['file'] = $arr_file;
		
		return $arr_entity_info;
	}
	/*
	 * 内容实体加工(视频商品)
	 */
	public function getEntityVideo($str_entity_id,$str_entity_type){
		$arr_entity_info = array();
		
		$arr_entitydata = array();
		$arr_metadata = array();
		$arr_file = array('low'=>'','high'=>'');
		
		$obj_xml_entity = self::getEntityDetailInfo($str_entity_id,$str_entity_type);
		
		//得到内容实体数据
		$obj_node_entity = $obj_xml_entity->getElementsByTagName("EntityData")->item(0);
		
		foreach ( $obj_node_entity->childNodes as $obj_node ) {
			$arr_entitydata[strtolower($obj_node->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_node->getElementsByTagName("Value")->item(0)->nodeValue;
		}
		
		$obj_metadata =  $obj_xml_entity->getElementsByTagName("Metadata")->item(0);
		
		//得到关键帧等 编目数据
		foreach ( $obj_metadata->childNodes as $obj_node ) {
			
			if ($obj_node->getElementsByTagName("TypeID")->item(0)->nodeValue == 'KEYFRAME'){//关键帧信息
				$obj_keyframe = $obj_node->getElementsByTagName("Attributes");
				foreach ( $obj_keyframe as $obj_attribute ){
					$arr_keyframe_node = array();
					if ($obj_attribute->hasChildNodes()){
						foreach ( $obj_attribute->childNodes as $obj_item ) {
							$arr_keyframe_node[strtolower($obj_item->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_item->getElementsByTagName("Value")->item(0)->nodeValue;
						}
					}
					$arr_metadata[strtolower('KEYFRAME')][] = $arr_keyframe_node;
				}
				
			}else if ($obj_node->getElementsByTagName("TypeID")->item(0)->nodeValue == 'CUSTOMCLIPMETADATA'){
				$obj_nodelist = $obj_node->getElementsByTagName("Item");
				$arr_custom_clip_metadata = array();
				foreach ( $obj_nodelist as $obj_item ) {
					$arr_custom_clip_metadata[strtolower($obj_item->getElementsByTagName("Code")->item(0)->nodeValue)] = $obj_item->getElementsByTagName("Value")->item(0)->nodeValue;
				}
				$arr_metadata[strtolower('CUSTOMCLIPMETADATA')]=$arr_custom_clip_metadata;
			}
		}
		
		$arr_entity_info = array(
						'entitydata' =>$arr_entitydata,
						'metadata'=>$arr_metadata
					);
		
					
		//得到低码视频地址（等待处理）
		$obj_node_filedata = $obj_xml_entity->getElementsByTagName("FileData")->item(0);
		foreach ( $obj_node_filedata->childNodes as $obj_file ) {
			//var_dump($obj_file);
			if ($obj_file->getElementsByTagName("QualityType")->item(0)->nodeValue==1){//低码文件
				$file = $obj_file->getElementsByTagName("Instance")->item(0);
				$arr_file['low'] = $file->getElementsByTagName("FullPath")->item(0)->nodeValue;
			}
			if ($obj_file->getElementsByTagName("QualityType")->item(0)->nodeValue==0){//高码文件
				 $arr_file['size'] = $obj_file->getElementsByTagName("Size")->item(0)->nodeValue;
				 $file = $obj_file->getElementsByTagName("Instance")->item(0);
				 $arr_file['high'] = $file->getElementsByTagName("FullPath")->item(0)->nodeValue;
			}
		}
		$arr_entity_info['file'] = $arr_file;
		
		$int_entity_type_id = $arr_entity_info['entitydata']['entitytypeid'];
		$int_entity_id = $arr_entity_info['entitydata']['id'];
		//print_r($arr_entity_info);exit;
		
		//得到该素材信息的属性列表
		$arr_attributes = self::getAttributesInfo($int_entity_type_id,$int_entity_id);
		//v($arr_attributes,1);
		if( is_array($arr_attributes) && !empty($arr_attributes)){
			if (count($arr_attributes)>0){
				foreach($arr_attributes as $attr){//多个镜头多个场景
					$key = 0;	
					if (isset($arr_entity_info['attribute'][$attr['attribute_show_name']])){
						$key = count($arr_entity_info['attribute'][$attr['attribute_show_name']]);
					}
					
					$attribute_detail = self::getAttributesDetail($int_entity_type_id,$int_entity_id,$attr['attribute_type_id'],$attr['attribute_id']);
					if (!empty($attribute_detail)){
						$arr_entity_info['attribute'][$attr['attribute_show_name']][$key] = self::list2row($attribute_detail['Attributes']['Item']);
					}
				}
			}
		}
		//print_r($arr_entity_info);exit;	
		return $arr_entity_info;
	}
	
	/*
	 * 获取实体(素材)详细信息
	 * param $EntityId  素材编号 32位的id
	 * param $EntityType  素材类型 （视频默认 Clip）
	 * XSpace_Content::getEntityDetailInfo('6B1D746D09584bebA7B2AB9D50772823','Clip');//测试数据
	 */
	public static function getEntityDetailInfo($str_entity_id,$str_entity_type){
		$obj_params = null;
		$obj_soap = null;
		$obj_response = null;
		$arr_return = array();
		
		$obj_params->entityRequest = self::entityRequest($str_entity_id,$str_entity_type);
		
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->getEntityDetailInfoByContentId($obj_params);
		
		if(is_object($obj_response)){
			//$xmlobj = simplexml_load_string($obj_response->return);
			//$arr_return = json_decode(json_encode($xmlobj),TRUE);
			//print_r($obj_response->return);
			//exit;
			$obj_xml = new DOMDocument();
			$obj_xml->loadXML($obj_response->return);
		}
		return $obj_xml;
	}
	
	/*
	 * 获取实体（素材）详情Request
	 */
	public static function entityRequest($str_entity_id,$str_entity_type){
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<entityRequest>
</entityRequest>
XML;
		$obj_xml = simplexml_load_string($str_xml);
		$obj_xml->addChild('ContentID',$str_entity_id);//订阅规则ID
		$obj_xml->addChild('EntityType',$str_entity_type);//订阅规则ID
		
		return $obj_xml->asXML();
	}
	/*
	 * 基本检索请求
	 * param $params  参数数组
	 * param $page  起始页
	 * param $pagesize  分页大小
	 */
	public static function search($str_keyword,$int_page,$int_pagesize){
		$int_search_type = 1;
		$obj_params = null;
		$obj_soap = null;
		$obj_response = null;
		$arr_return = array();
		
		$obj_params->xdaContentAcquireRequest = self::searchRequest($str_keyword,$int_page,$int_pagesize);
		
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->search($obj_params);
		$array = array();
		if(is_object($obj_response)){
			$arr_return = self::_getSearchList($obj_response,$int_search_type);	
		}
		return $arr_return;
	}
	/*
	 * 高级检索请求(待完善)
	 * param $params  参数数组
	 * param $page  起始页
	 * param $pagesize  分页大小
	 */
	public static function advancedSearch($arr_params,$int_page,$int_pagesize){
		$int_search_type = 2;
		$obj_params = null;
		$obj_soap = null;
		$obj_response = null;
		$arr_return = array();
		
		
		$obj_params->advancedSearchRequest = self::advancedSearchRequest($arr_params,$int_page,$int_pagesize);
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->advancedSearch($obj_params,$int_search_type);
		
		if(is_object($obj_response)){
			$arr_return = self::_getSearchList($obj_response);
		}
		//print_r($arr_return);
		return $arr_return;
	}

	/*
	 * 素材删除接口
	 * param $str_username  操作用户账号
	 * param $arr_entitys  要删除的素材数组
	 *   素材数组示例  $arr_entitys = array('str_content_id'=>,'int_entity_id'=>,'int_entity_type_id'=>,'str_entityname'=>);
	 * 
	 */
	public static function entityDelete($str_username,$arr_entitys){
		
		$obj_params->EntityLogicDeleteRequest = self::entityLogicDeleteRequest($str_username,$arr_entitys);
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->logicDelete($obj_params);
		
		if(is_object($obj_response)){
			if (isset($obj_response->return)){		
				$obj_xml = new DOMDocument();
				$obj_xml->loadXML($obj_response->return);
				$obj_root = $obj_xml ->documentElement;//根目录
				$obj_attributes = $obj_xml->getElementsByTagName("LogicDeleteResult");
				
				foreach ($obj_attributes as $obj_attribute){
					$arr_info['str_content_id'] = $obj_attribute->getElementsByTagName("contentID")->item(0)->nodeValue;
					$arr_info['int_entity_type_id'] = $obj_attribute->getElementsByTagName("entityTypeID")->item(0)->nodeValue;
					$arr_info['int_entity_id'] = $obj_attribute->getElementsByTagName("entityID")->item(0)->nodeValue;
					$arr_info['str_entity_name'] = $obj_attribute->getElementsByTagName("entityName")->item(0)->nodeValue;
					$arr_info['int_isdelete'] = $obj_attribute->getElementsByTagName("is_delete")->item(0)->nodeValue;
					$arr_info['str_reson'] = $obj_attribute->getElementsByTagName("reson")->item(0)->nodeValue;
					$arr_return[] = $arr_info;
				}
			}
		}
		return $arr_return;
	}
	
	/*
	 * 得到服务地址URL
	 */
	private function getServiceUrl(){
		return Yii::app()->params['xspace_webservice']['content'];
	}
	/*
	 * 搜索列表信息解析
	 */
	private function _getSearchList($obj_response,$int_search_type=2){
		$arr_return = array();

		if(is_object($obj_response)){
			$obj_xml = new DOMDocument();
			$obj_xml->loadXML($obj_response->return);
			$arr_return['total_count'] =  $obj_xml->getElementsByTagName("TotalCount")->item(0)->nodeValue;
			$obj_node_list = $obj_xml->getElementsByTagName("IntegrationSearchData");
			foreach ($obj_node_list as $obj_node){
				$arr_info['entity_id'] = $obj_node->getElementsByTagName("EntityID")->item(0)->nodeValue;
				$arr_info['entity_type_id'] = $obj_node->getElementsByTagName("EntityTypeID")->item(0)->nodeValue;
				$arr_info['content_id'] = $obj_node->getElementsByTagName("ContentID")->item(0)->nodeValue;
				$arr_info['create_time'] = $obj_node->getElementsByTagName("CreateTime")->item(0)->nodeValue;
				$arr_info['name'] = $obj_node->getElementsByTagName("Name")->item(0)->nodeValue;
				$arr_info['duration'] = $obj_node->getElementsByTagName("Duration")->item(0)->nodeValue;
				$arr_info['key_frame'] = $obj_node->getElementsByTagName("KeyFrame")->item(0)->nodeValue;
				$arr_info['bar_code'] = $obj_node->getElementsByTagName("BarCode")->item(0)->nodeValue;
				$arr_info['location'] = $obj_node->getElementsByTagName("Location")->item(0)->nodeValue;
				$arr_info['storage_state'] = $obj_node->getElementsByTagName("StorageState")->item(0)->nodeValue;
				
				$arr_info['description_content'] = $obj_node->getElementsByTagName("DescriptionContent")->item(0)->nodeValue;
				$arr_info['creator'] = $obj_node->getElementsByTagName("Creator")->item(0)->nodeValue;
				$arr_info['frame_rate'] = $obj_node->getElementsByTagName("FrameRate")->item(0)->nodeValue;
				$arr_info['keywords'] = $obj_node->getElementsByTagName("Keywords")->item(0)->nodeValue;
				if ($int_search_type!=1){
					$arr_info['business_count'] = $obj_node->getElementsByTagName("BusinessCount")->item(0)->nodeValue;
				}
				//分类信息多个分类
				$arr_category = array();
				$obj_node_categorys = $obj_node->getElementsByTagName("Category");
				foreach ($obj_node_categorys as $obj_node_category){
					//print_r($obj_node_category);
					$arr_category['code'] = $obj_node_category->getElementsByTagName("Code")->item(0)->nodeValue;
					if ($int_search_type==1){
						$arr_category['calue'] = $obj_node_category->getElementsByTagName("Value")->item(0)->nodeValue;
					}
					if ($int_search_type==2){
						$arr_category['name'] = $obj_node_category->getElementsByTagName("Name")->item(0)->nodeValue;
					}
				}
				//其他附加信息
				$arr_rest_values = array();
				$obj_node_rest_values = $obj_node->getElementsByTagName("Item");
				foreach ($obj_node_rest_values as $obj_node_item){
					$arr_rest_values[$obj_node_item->getElementsByTagName("Code")->item(0)->nodeValue] = $obj_node_item->getElementsByTagName("Value")->item(0)->nodeValue;
				}
				
				$arr_info['categorys'] = $arr_category;
				$arr_info['rest_values'] = $arr_rest_values;
				$arr_return['list'][] = $arr_info;
			}
		}
		return $arr_return;
	}

	
	
	/*
	 * 获取编目数据列表
	 */
	public static function getAttributesInfo($int_entity_type_id,$int_entity_id){
		$obj_params = null;
		$obj_soap = null;
		$obj_response = null;
		$arr_return = array();
		
		$obj_params->xdaContentAcquireRequest = self::attributesInfoRequest($int_entity_type_id,$int_entity_id);
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->getAttributesInfo($obj_params);
		
		
		if(is_object($obj_response)){
			if (isset($obj_response->return)){		
				$obj_xml = new DOMDocument();
				$obj_xml->loadXML($obj_response->return);
				$obj_root = $obj_xml ->documentElement;//根目录
				$obj_attributes = $obj_xml->getElementsByTagName("Attribute");
				
				foreach ($obj_attributes as $obj_attribute){
					$arr_info['entity_id'] = $obj_attribute->getElementsByTagName("entityID")->item(0)->nodeValue;
					$arr_info['entity_type_id'] = $obj_attribute->getElementsByTagName("entityTypeID")->item(0)->nodeValue;
					$arr_info['attribute_id'] = $obj_attribute->getElementsByTagName("attributeID")->item(0)->nodeValue;
					$arr_info['keyframe_path'] = $obj_attribute->getElementsByTagName("keyframePath")->item(0)->nodeValue;
					$arr_info['proper_title'] = $obj_attribute->getElementsByTagName("properTitle")->item(0)->nodeValue;
					$arr_info['attribute_show_name'] = $obj_attribute->getElementsByTagName("attributeShowName")->item(0)->nodeValue;
					$arr_info['inpoint'] = $obj_attribute->getElementsByTagName("inpoint")->item(0)->nodeValue;
					$arr_info['outpoint'] = $obj_attribute->getElementsByTagName("outpoint")->item(0)->nodeValue;
					$arr_info['attributes_clob'] = $obj_attribute->getElementsByTagName("attributesClob")->item(0)->nodeValue;
					$arr_info['attribute_type_id'] = $obj_attribute->getElementsByTagName("attributeTypeID")->item(0)->nodeValue;
					$arr_info['attribute_out_name'] = $obj_attribute->getElementsByTagName("attributeOutName")->item(0)->nodeValue;
					$arr_info['high_light_proper_title'] = $obj_attribute->getElementsByTagName("highLightProperTitle")->item(0)->nodeValue;
					$arr_return[] = $arr_info;
				}
			}
			
		}
		return $arr_return;
	}
	
	/*
	 * 获取编目数据详细信息
	 */
	public static function getAttributesDetail($int_entity_type_id,$int_entity_id,$int_attribute_type_id,$int_attirbute_id){
		
		$obj_params->xdaContentAcquireRequest = self::AttributesDetailRequest($int_entity_type_id,$int_entity_id,$int_attribute_type_id,$int_attirbute_id);
		
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->getAttributesDetail($obj_params);
		$array = array();
		if(is_object($obj_response)){
			$obj_xml = simplexml_load_string($obj_response->return);
			$obj_xml_detail = simplexml_load_string($obj_xml->attributesClob);//得到编目的详细信息
			$array = json_decode(json_encode($obj_xml_detail),TRUE);
		}
		return $array;
	}
	
	/*
	 * 商品化标记信息接口
	 */
	
	public static function commercializedEntity($ste_entity_type,$str_entity_id){
		$obj_params->entityRequest = self::commercializedRequest($ste_entity_type,$str_entity_id);
		//print_r($params->entityRequest);
		//exit;
		$obj_soap = new SoapClient(self::getServiceUrl());
		$obj_response = $obj_soap->commercializedEntity($obj_params);
		$array = array();
		$bool_return = false;
		if(is_object($obj_response)){
			if ($obj_response->return=='sucessed'){
				$bool_return = true;
			}else{
				$bool_return = false;
			}
		}
		return $bool_return;
	}
	
	/*
	 * 基本检索请求的xml
	 */
	public static function searchRequest($str_keyword,$int_page,$int_pagesize){
		if ($int_page==0){$int_page=1; };
		/*$start = ($page-1)*$pagesize;
		if($start==0){$start=1;}*/
		
		if($str_keyword != '' && $str_keyword!= '*'){
			$str_keyword = '*'.$str_keyword.'*';
		}
		if (empty($str_keyword)){
			$str_keyword = '*';
		}
		
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<xdaContentAcquireRequest>
</xdaContentAcquireRequest>
XML;
		$obj_xml = simplexml_load_string($str_xml);
		$obj_xml->addChild('UserID','-13708089795');//登陆用户ID固定值
		$obj_request_xml = $obj_xml->addChild('SearchRequset');//登陆用户ID固定值
		
		$obj_request_xml->addChild('Keyword',$str_keyword);//分页起始
		$obj_request_xml->addChild('Start',$int_page);//分页起始
		$obj_request_xml->addChild('Size',$int_pagesize);//分页大小
		
		return $obj_xml->asXML();	
	}
	
	/*
	 * 高级检索请求XML
	 */
	public static function advancedSearchRequest($arr_params,$int_page,$int_pagesize){
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<AdvancedSearchRequest>
</AdvancedSearchRequest>
XML;

		//echo $params['keyword'];

		$obj_xml = simplexml_load_string($str_xml);
		
		$obj_xml->addChild('Start',$int_page);//分页起始
		$obj_xml->addChild('Size',$int_pagesize);//分页大小
		
		if (!empty($arr_params) && is_array($arr_params)){
			
			//素材名称 entityName
			$obj_keywords_xml = $obj_xml->addChild('KeywordConditions');//订阅规则ID
			if (isset($arr_params['entityName']) && $arr_params['entityName']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','entityName');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue','*'.$arr_params['entityName'].'*');
			}
			//素材 分类 category
			if (isset($arr_params['category']) && $arr_params['category']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','category');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue',$arr_params['category']);
			}
			//素材 描述 descriptionOfContent
			if (isset($arr_params['descriptionOfContent']) && $arr_params['descriptionOfContent']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','descriptionOfContent');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue','*'.$arr_params['descriptionOfContent'].'*');
			}
			//素材 入库时间importDate[2012-03-10 00:00:00 TO 2013-06-07 10:31:08]
			if (isset($arr_params['importDate']) && $arr_params['importDate']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','importDate');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue',$arr_params['importDate']);
			}
			//素材 幅面aspect
			if (isset($arr_params['aspect']) && $arr_params['aspect']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','aspect');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue','*'.$arr_params['aspect'].'*');
			}
			//素材 地区area
			if (isset($arr_params['area']) && $arr_params['area']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','area');
				$obj_keyword_xml->addChild('ProperSource','CUSTOMCLIPMETADATA');
				$obj_keyword_xml->addChild('ProperValue','*'.$arr_params['area'].'*');
			}
			//素材 时长duration[[0 TO 1556400000]
			if (isset($arr_params['duration']) && $arr_params['duration']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','duration');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue','*'.$arr_params['duration'].'*');
			}
			//素材 类型entityTypeName
			if (isset($arr_params['entityTypeName']) && $arr_params['entityTypeName']!=''){
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','entityTypeName');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue',$arr_params['entityTypeName']);
			
			}
			//素材 关键字keywords
			if (isset($arr_params['keyword']) && $arr_params['keyword']!=''){//关键词
				
				$obj_keyword_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_keyword_xml->addChild('ProperName','keywords');
				$obj_keyword_xml->addChild('ProperSource','INDEX');
				$obj_keyword_xml->addChild('ProperValue','*'.$arr_params['keyword'].'*');
			}//素材 是否商品化businessCount
			if (isset($arr_params['business']) && $arr_params['business']!==''){//是否商品化
				if ($arr_params['business'] === '1'){
					$arr_params['business'] = '[1 TO *]';
				}
				$obj_business_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_business_xml->addChild('ProperName','businessCount');
				$obj_business_xml->addChild('ProperSource','INDEX');
				$obj_business_xml->addChild('ProperValue',$arr_params['business']);
			}
			//素材 供应商CPName
			if (isset($arr_params['CPName']) && $arr_params['CPName']!==''){
				$obj_business_xml = $obj_keywords_xml->addChild('KeywordCondition');
				$obj_business_xml->addChild('ProperName','CPName');
				$obj_business_xml->addChild('ProperSource','CUSTOMCLIPMETADATA');
				$obj_business_xml->addChild('ProperValue',$arr_params['CPName']);
			}
		}
		$obj_order_xml = $obj_xml->addChild('OrderCondition');//订阅规则ID
		$obj_order_xml->addChild('ProperName','importDate');
		$obj_order_xml->addChild('ProperSource','INDEX');
		$obj_order_xml->addChild('IsDesc','TRUE');
		
		return $obj_xml->asXML();
	}
	
	/*
	 * 属性列表请求的xml
	 */
	public static function attributesInfoRequest($int_entity_type_id,$int_entity_id){
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<xdaContentAcquireRequest>
</xdaContentAcquireRequest>
XML;
		$obj_xml = simplexml_load_string($str_xml);
		$obj_xml->addChild('entityTypeID',$int_entity_type_id);
		$obj_xml->addChild('entityID',$int_entity_id);
		
		return $obj_xml->asXML();
	}
	/*
	 * 属性详细信息的请求XML
	 */
	public static function attributesDetailRequest($int_entity_type_id,$int_entity_id,$int_attribute_type_id,$int_attirbute_id){
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<xdaContentAcquireRequest>
</xdaContentAcquireRequest>
XML;
		$obj_xml = simplexml_load_string($str_xml);
		
		$obj_xml->addChild('entityTypeID',$int_entity_type_id);
		$obj_xml->addChild('entityID',$int_entity_id);
		$obj_xml->addChild('attributeTypeID',$int_attribute_type_id);
		$obj_xml->addChild('attirbuteID',$int_attirbute_id);
		
		return $obj_xml->asXML();
	}
	
	/*
	 * 商品化请求的xml
	 */
	public static function commercializedRequest($str_entity_type,$str_entity_id){
		
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<entityRequest>
</entityRequest>
XML;
		$obj_xml = simplexml_load_string($str_xml);
		
		$obj_xml->addChild('ContentID',$str_entity_type);//内容编号
		$obj_xml->addChild('EntityType',$str_entity_id);//内容类型
		
		return $obj_xml->asXML();	
	}
	
	/*
	 * 删除素材接口请求协议
	 */
	public static function entityLogicDeleteRequest($str_username,$arr_entitys){
		$str_xml = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<EntityLogicDeleteRequest>
</EntityLogicDeleteRequest>
XML;
		$obj_xml = simplexml_load_string($str_xml);
		$obj_xml->addChild('userCode',$str_username);
		$obj_entitys_xml = $obj_xml->addChild('entitys');
		
		
		if (!empty($arr_entitys) && is_array($arr_entitys)){
			foreach ($arr_entitys as $arr_entity){
				$obj_entity_xml = $obj_entitys_xml->addChild('Entity');
				$obj_entity_xml->addChild('contentID',$arr_entity['str_content_id']);
				$obj_entity_xml->addChild('entityID',$arr_entity['int_entity_id']);
				$obj_entity_xml->addChild('entityTypeID',$arr_entity['int_entity_type_id']);
				$obj_entity_xml->addChild('entityName',$arr_entity['str_entityname']);
			}
			
		}
		
		return $obj_xml->asXML();
	}
	/** 
	*
	* 将domNode转为数组 
	* @param DOMNode $oDomNode 
	*/
	private function _domNodeToArray(DOMNode $obj_dom_node = null) {
		// return empty array if dom is blank
		if (!$obj_dom_node->hasChildNodes()){
			$tmp_result=$obj_dom_node->nodeValue;
		}else {
			$tmp_result = array ();
			foreach ( $obj_dom_node->childNodes as $obj_child_node ) {
				// how many of these child nodes do we have?
				// this will give us a clue as to what the result structure should be
				$obj_child_node_list = $obj_dom_node->getElementsByTagName ( $obj_child_node->nodeName );
				$int_child_count = 0;
				// there are x number of childs in this node that have the same tag name
				// however, we are only interested in the # of siblings with the same tag name
				foreach ( $obj_child_node_list as $obj_node ) {
					if ($obj_node->parentNode->isSameNode ( $obj_child_node->parentNode )) {
						$int_child_count ++;
					}
				}
				$tmp_value = self::_domNodeToArray ( $obj_child_node );
				$sKey = ($obj_child_node->nodeName {0} == '#') ? 0 : $obj_child_node->nodeName;
				$tmp_value = is_array ( $tmp_value ) ? $tmp_value [$obj_child_node->nodeName] : $tmp_value;
				// how many of thse child nodes do we have?
				if ($int_child_count > 1) { // more than 1 child - make numeric array
					$tmp_result [$sKey] [] = $tmp_value;
				} else {
					$tmp_result [$sKey] = $tmp_value;
				}
			}
			// if the child is <foo>bar</foo>, the result will be array(bar)
			// make the result just 'bar'
			if (count ( $tmp_result ) == 1 && isset ( $tmp_result [0] ) && ! is_array ( $tmp_result [0] )) {
				$tmp_result = $tmp_result [0];
			}
		}
		// get our attributes if we have any
		$arr_attributes = array ();
		if ($obj_dom_node->hasAttributes ()) {
			foreach ( $obj_dom_node->attributes as $str_attrName => $obj_attr_node ) {
				// retain namespace prefixes
				$arr_attributes ["@{$obj_attr_node->nodeName}"] = $obj_attr_node->nodeValue;
			}
		}
		// check for namespace attribute - Namespaces will not show up in the attributes list
		if ($obj_dom_node instanceof DOMElement && $obj_dom_node->getAttribute ( 'xmlns' )) {
			$arr_attributes ["@xmlns"] = $obj_dom_node->getAttribute ( 'xmlns' );
		}
		if (count ( $arr_attributes )) {
			if (! is_array ( $tmp_result )) {
				$tmp_result = (trim ( $tmp_result )) ? array ($tmp_result ) : array ();
			}
			$tmp_result = array_merge ( $tmp_result, $arr_attributes );
		}
		
		$arr_result = array ($obj_dom_node->nodeName => $tmp_result );
		
		return $arr_result;
	}
	
	/*
	 * 实体（素材数据转换）
	 */
	public function list2row($arr_list,$key_name='Code',$val_name='Value'){
		$_array = array();
		if (is_array($arr_list)){
			foreach ($arr_list as $arr_info){
				if (isset($arr_info[$key_name]) && isset($arr_info[$val_name])){
					$_array[strtolower($arr_info[$key_name])]=$arr_info[$val_name];
				}
			}
		}
		return $_array;
	}
}