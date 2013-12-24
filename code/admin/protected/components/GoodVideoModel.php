<?php
/**
 * 视频商品信息模型管理
 * 
 * @author     qiweigang 
 * @date       2013-06-04
 * @version    1.0 
 */

class GoodVideoModel {
	
	public $int_good_id; //视频商品编号
	public $str_video_format; //视频格式
	public $str_audio_format; //音频格式
	public $str_resolution; //分辨率
	public $int_screen_width;//画面高度
	public $int_screen_height;//画面宽度
	public $str_source; //来源
	public $str_copyright_duration; //版权期限
	public $str_copyright_type; //版权类型
	public $str_belongschannel; //所属频道
	public $str_belongscolumn; //所属节目
	public $str_presentation; //文稿
	public $str_category; //商品分类
	public $str_category_name; //商品分类名称
	public $str_events; //事件
	public $str_themecharacters; //人物
	public $str_area; //地区
	public $str_takentime; //拍摄时间
	public $str_subtitlelanguage; //字幕语言
	public $str_aspectratios; //画面宽高比
	public $str_contentid; //内容编号
	public $int_entity_id; //内容实体编号
	public $int_entity_typeid; //内容分类编号
	public $int_duration; //时长
	public $str_good_title; //标题
	public $str_good_keyword; //关键词
	public $str_good_description; //描述
	public $str_video_type; //视频类型
	public $str_supplier; //供应商名称
	public $str_supplier_account;//供应商账号
	//public $str_copyrightscope; //版权范围
	public $str_filesrc_low;//低码视频文件地址
	public $str_filesrc_high;//低码视频文件地址
	public $fl_framerate;//播放帧率
	public $str_playbackspeed ;//播放速度
	public $str_age;//年龄
	public $str_sex;//性别
	public $str_people;//人数
	public $str_season;//拍摄季节
	public $int_size;//文件大小
	
	public $arr_shotlist = array(); //编目信息镜头层列表信息
	public $arr_scenelist = array(); //编目信息场景层列表信息
	public $arr_goodimagelist = array(); //商品相册列表信息
	
	public function __construct($arr_entity_info)
	{
		$this->str_video_format =PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'videoformat');
		$this->str_audio_format =PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'audioformat');
		if (empty($this->str_video_format)){
			$this->str_video_format =PublicFunction::str_Empty($arr_entity_info['entitydata'],'videoformat');
		}
		if (empty($this->str_audio_format)){
			$this->str_audio_format = PublicFunction::str_Empty($arr_entity_info['entitydata'],'audioformat');
		}
		$this->str_resolution = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'resolution');
		$this->fl_framerate = PublicFunction::str_Empty($arr_entity_info['entitydata'],'framerate');
		$this->int_screen_width = 0;
		$this->int_screen_height = 0;
		if (!empty($this->str_resolution)){
			$screen =  explode('x',$this->str_resolution) ;
			$this->int_screen_width = $screen[0];
			$this->int_screen_height = $screen[1];
		}
		
		$this->str_source = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'source');
		if (empty($this->str_source)){
			$this->str_source = PublicFunction::str_Empty($arr_entity_info['entitydata'],'source') ;
		}
		$this->str_copyright_duration = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'copyrightduration');
		$this->str_copyright_type = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'copyrightscope') ;
		$this->str_belongschannel = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'belongschannel');
		$this->str_belongscolumn = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'belongscolumn');
		//$this->str_presentation = PublicFunction::str_Empty($arr_entity_info['metadata']['KEYFRAME'],'presentation');
		$this->str_presentation = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'presentation');
		$this->str_category  = PublicFunction::str_Empty($arr_entity_info['entitydata'],'category');
		$this->str_category_name = PublicFunction::str_Empty($arr_entity_info['entitydata'],'categoryname');
		
		//$this->str_events = PublicFunction::str_Empty($arr_entity_info['metadata']['keyframe'],'events');
		//$this->str_themecharacters = PublicFunction::str_Empty($arr_entity_info['metadata']['keyframe'],'themecharacters');
		
		$this->str_events = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'events');
		$this->str_themecharacters = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'themecharacters');
		$this->str_area = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'area');
		
		if (isset($arr_entity_info['metadata']['keyframe'])){
			$this->str_takentime = PublicFunction::str_Empty($arr_entity_info['metadata']['keyframe'],'takentime');
		}
		//$this->str_subtitlelanguage = PublicFunction::str_Empty($arr_entity_info['metadata']['keyframe'],'subtitlelanguage');
		$this->str_subtitlelanguage = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'subtitlelanguage');
		$this->str_aspectratios = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'aspectratios');
		if (isset($arr_entity_info['entitydata']['duration'])){
			$this->int_duration = $arr_entity_info['entitydata']['duration'];
		}
		
		$this->str_good_title = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'name');
		$this->str_good_keyword = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'keyword');
		$this->str_good_keyword = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'description');
		if (empty($this->str_good_title)){
			$this->str_good_title = PublicFunction::str_Empty($arr_entity_info['entitydata'],'name');
		}
		if (empty($this->str_good_keyword)){
			$this->str_good_keyword = PublicFunction::str_Empty($arr_entity_info['entitydata'],'keyword');
		}
		if (empty($this->str_good_keyword)){
			$this->str_good_keyword = PublicFunction::str_Empty($arr_entity_info['entitydata'],'description');
		}
		
		$this->str_video_type = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'videotype');
		$this->int_entity_id = PublicFunction::str_Empty($arr_entity_info['entitydata'],'id');
		$this->int_entity_typeid = PublicFunction::str_Empty($arr_entity_info['entitydata'],'entitytypeid');
		$this->str_contentid = PublicFunction::str_Empty($arr_entity_info['entitydata'],'contentid');
		$this->str_supplier = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'cpname');
		
		/*
		 * 2013-8-14 新增编目数据
		 */
		$this->str_playbackspeed = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'playbackspeed');
		$this->str_age = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'age');
		$this->str_sex = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'sex');
		$this->str_people = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'people');
		$this->str_season = PublicFunction::str_Empty($arr_entity_info['metadata']['customclipmetadata'],'season');
		
		//测试数据
		if (empty($this->str_supplier)){
			$this->str_supplier = '文创科技';
		}
		if (isset($arr_entity_info['metadata']['keyframe'])){
			$this->arr_goodimagelist = $arr_entity_info['metadata']['keyframe'];
		}
		//编目层数据
		$this->arr_shotlist = array();
		$this->arr_scenelist = array();
		if (isset($arr_entity_info['attribute'])){
			//镜头层信息
			if (isset($arr_entity_info['attribute']['DCMA_SHOT']) && is_array($arr_entity_info['attribute']['DCMA_SHOT']) && !empty($arr_entity_info['attribute']['DCMA_SHOT'])){
				$this->arr_shotlist = $arr_entity_info['attribute']['DCMA_SHOT'];
			}
			if (isset($arr_entity_info['attribute']['SCENE']) && is_array($arr_entity_info['attribute']['SCENE']) && !empty($arr_entity_info['attribute']['SCENE'])){
					$this->arr_scenelist = $arr_entity_info['attribute']['SCENE'];
			}
		}
		//得到高低码视频地址
		$this->str_filesrc_low = $arr_entity_info['file']['low'];
		$this->str_filesrc_high = $arr_entity_info['file']['high'];
		if (!empty($arr_entity_info['file']['size'])){
			$this->int_size = sprintf("%.2f",(($arr_entity_info['file']['size']/1024)/1024));
		}
		
	}
}