<?php
/**
 * 视频商品信息模型管理
 * 
 * @author     qiweigang 
 * @date       2013-06-04
 * @version    1.0 
 */

class GoodPictureModel {
	
	public $int_good_id; //视频商品编号
	public $str_contentid; //内容编号
	public $int_entity_id; //内容实体编号
	public $int_entity_typeid; //内容分类编号
	
	public $str_picext; //图片格式
	public $str_resolution; //分辨率
	public $int_screen_width;//画面高度
	public $int_screen_height;//画面宽度
	public $str_source; //来源
	public $str_takentime; //拍摄时间
	public $str_photographer; //拍摄者
	public $str_equipment; //拍摄装备
	public $str_copyright_duration; //版权期限
	public $str_copyright_type; //版权类型
	public $str_good_title; //标题
	public $str_good_keyword; //关键词
	public $str_good_description; //描述
	public $str_category; //商品分类
	public $str_category_name; //商品分类名称
	public $str_events; //事件
	public $str_themecharacters; //人物
	public $str_area; //地区
	public $str_scene; //景别
	public $str_composition; //构图方式
	public $str_angle; //拍摄角度
	public $str_filesrc; //文件地址
	public $str_supplier; //供应商
	
	
	public function __construct($arr_entity_info)
	{
		$this->str_picext = PublicFunction::str_Empty($arr_entity_info['entitydata'],'picext');
		$this->str_resolution = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'resolution');
		$this->int_screen_width = 0;
		$this->int_screen_height = 0;
		if (!empty($this->str_resolution)){
			$screen =  explode('x',$this->str_resolution) ;
			$this->int_screen_width = $screen[0];
			$this->int_screen_height = $screen[1];
		}
		$this->str_source = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'source');
		if (empty($this->str_source)){
			$this->str_source = PublicFunction::str_Empty($arr_entity_info['entitydata'],'source') ;
		}
		$this->str_takentime = PublicFunction::str_Empty($arr_entity_info['metadata']['keyframe'],'takentime');
		$this->str_photographer = '';
		$this->str_equipment = '';
		
		$this->str_copyright_duration = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'copyrightduration');
		$this->str_copyright_type = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'copyrightscope') ;
		$this->str_good_title = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'name');
		$this->str_good_keyword = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'keyword');
		$this->str_good_description = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'description');
		if (empty($this->str_good_title)){
			$this->str_good_title = PublicFunction::str_Empty($arr_entity_info['entitydata'],'name');
		}
		if (empty($this->str_good_keyword)){
			$this->str_good_keyword = PublicFunction::str_Empty($arr_entity_info['entitydata'],'keyword');
		}
		if (empty($this->str_good_description)){
			$this->str_good_description = PublicFunction::str_Empty($arr_entity_info['entitydata'],'description');
		}
		$this->str_category  = PublicFunction::str_Empty($arr_entity_info['entitydata'],'category');
		$this->str_category_name = PublicFunction::str_Empty($arr_entity_info['entitydata'],'categoryname');
		$this->str_events = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'events');
		$this->str_themecharacters = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'themecharacters');
		$this->str_area = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'area');
		$this->str_scene = '';
		$this->str_composition = '';
		$this->str_angle = '';
		
		$this->int_entity_id = PublicFunction::str_Empty($arr_entity_info['entitydata'],'id');
		$this->int_entity_typeid = PublicFunction::str_Empty($arr_entity_info['entitydata'],'entitytypeid');
		$this->str_contentid = PublicFunction::str_Empty($arr_entity_info['entitydata'],'contentid');
		$this->str_supplier = PublicFunction::str_Empty($arr_entity_info['metadata']['custompicturemetadata'],'cpname');
		//测试数据
		if (empty($this->str_supplier)){
			$this->str_supplier = '文创科技';
		}
		
		//得到图片文件地址
		$this->str_filesrc = $arr_entity_info['file']['low'];
		
		
		
	}
}