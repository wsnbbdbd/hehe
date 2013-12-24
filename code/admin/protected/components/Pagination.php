<?php
/**
 * 分页公共控件扩展自Yii框架的widget
 * 
 * @author     齐维刚 
 * @date       2013-10-15 
 * @version    1.0
 * @param array $arr_page_param
 * $arr_page_param=array(
 *		@param int int_current_page 当前页 (必填)
 *		@param int int_page_size 分页大小(必填),
 *		@param int int_item_count 记录总条目数(必填),
 *		@param int int_url_type 链接样式(选填)  1：传统URLparam样式，2：urlwrite样式，默认为2 
 *		@param string str_page_var 分页传递参数(选填)  默认为page
 *		@param int int_show_num 分页链接展示数量(选填)  默认为5
 *		@param string str_class 分页样式(选填)  默认为page-box
 * )
 * 调用示例 在VIEW上直接 $this->widget('Pagination', array('arr_page_param' => $arr_page_param));
 */ 
	
class Pagination extends CWidget {
	public $arr_page_param ;
	private $str_page_var;
	private $int_show_num=5;
	private $str_class='pagination fr';
	private $int_type = 2;
	private $int_current;
	private $int_page_total;
	private $str_default_url ;
	
	//初始化函数
	public function run() {
		//参数处理
		$this->str_default_url = $this->getDefaultUrl();
		$obj_pager = new CPagination($this->arr_page_param['int_item_count']);
	    $obj_pager->pageSize = $this->arr_page_param['int_page_size'];
	    $obj_pager->setCurrentPage($this->arr_page_param['int_current_page']-1);
	    //分页参数字符串
		if ( isset($this->arr_page_param['str_page_var']) && !empty($this->arr_page_param['str_page_var'])){
	   		$obj_pager->pageVar = $this->arr_page_param['str_page_var'];
	    }
	    $this->str_page_var = $obj_pager->pageVar;
	    //链接类型
		if ( isset($this->arr_page_param['int_url_type']) && !empty($this->arr_page_param['int_url_type'])){
	   		$this->int_type = $this->arr_page_param['int_url_type'];
	    }
	    //展示数目
		if ( isset($this->arr_page_param['int_show_num']) && !empty($this->arr_page_param['int_show_num'])){
	   		$this->int_show_num = $this->arr_page_param['int_show_num'];
	    }
	    //分页样式
		if ( isset($this->arr_page_param['str_class']) && !empty($this->arr_page_param['str_class'])){
	   		$this->str_class = $this->arr_page_param['str_class'];
	    }
		$this->int_current = $obj_pager->getCurrentPage()+1;
		$this->int_page_total = $obj_pager->getPageCount();
		$str_previous_url = $str_next_url ='';
		
		$this->render('pagination',array(
			'int_pages' => $this->int_page_total,
			'str_purl' => $this->getUrl(),
			'int_type' => $this->int_type,
			'int_current' => $this->int_current,
			'str_previous' => $this->getPrevious(),
			'str_next' => $this->getNext(),
			'str_pagetxt' => $this->getShowPage(),
			'str_class' => $this->str_class
		));
	}
	private function getDefaultUrl(){
		$str_route = Yii::app()->controller->id.'/'.Yii::app()->getController()->getAction()->id;
		$obj_module = Yii::app()->getController()->getModule();
		if($obj_module!==null){
			$str_route = $obj_module->getId().'/'.$str_route;
		}
		return  '/'.$str_route;
	}
	/*
	 * 生成前一页HTML代码
	 */
	public function getPrevious(){
		$str_previous_html = '<li class="disabled"><a>前一页</a></li>';
		if($this->int_current>1){
			$int_previous = ($this->int_current > 1) ? ($this->int_current-1) : 1;
			$str_previous_url = $this->getUrl($int_previous);
		}
		if (isset($str_previous_url) && $str_previous_url!=''){ 
			$str_previous_html =  '<li><a href="'.$str_previous_url.'" title="前一页" target="_self">前一页</a></li>';
		};
		return $str_previous_html;
	}
	/*
	 * 生成后一页的HTML代码
	 */
	public function getNext(){
		$str_next_html = '<li class="disabled">Next</li>';
		if($this->int_current<$this->int_page_total){
			$int_next = ($this->int_current < $this->int_page_total) ? ($this->int_current+1) : $this->int_page_total;
			$str_next_url = $this->getUrl($int_next);
		}
		if (isset($str_next_url) && $str_next_url!=''){
			$str_next_html = '<li><a class="next" href="'.$str_next_url.'" title="后一页 " target="_self">后一页</a></li>';
		};
		return $str_next_html;
	}
	/*
	 * 生成分页展示链接
	 */
	public function getShowPage(){
		//$str_purl = $this->getUrl();
		$str_pagetxt = '';
		if($this->int_page_total < $this->int_show_num){//如果总页数小于展示页数，全部展示
			for($i=1; $i <= $this->int_page_total; $i++){
				if($this->int_current == $i){
					$str_pagetxt .= '<li class="active"><a title="当前页" href="javascript:void(0);" target="_self">'.$i.'</a></li>';
				}else{
					$str_pagetxt .= '<li><a href="'.$this->getUrl($i).'" title="第'.$i.'页" target="_self">'.$i.'</a></li>';
				}
			}
		}else{//如果总页数大于展示页数，根据当前页，得到展示页
			$int_side_show = intval($this->int_show_num/2);
			$int_middle_show = $this->int_show_num%2;
			$int_middle_page = $int_side_show+$int_middle_show;
			
			if ($this->int_current<=$int_middle_page){
				$int_start_page = 1;
				$int_end_page = $this->int_show_num;
			}else{
				if ($this->int_page_total-$this->int_current>=$int_side_show){
					$int_start_page = $this->int_current-$int_side_show;
					$int_end_page = $this->int_current+$int_side_show;
				}else{
					if ($this->int_page_total <= $this->int_current){
						$int_start_page = $this->int_current - $this->int_show_num + 1;
					}else{
						$int_start_page = $this->int_page_total-$this->int_show_num;
					}
					$int_end_page = $this->int_page_total;
				}
				$str_pagetxt .= '<li class="disabled"><a>1...</a></li>';
			}
			
			if ($int_end_page>$this->int_page_total){
				$int_end_page = $this->int_page_total;
			}
			//显示数字页码
			for($i=$int_start_page; $i<=$int_end_page; $i++){
				if($this->int_current == $i){
					$str_pagetxt .= '<li class="active"><a  title="当前页" href="javascript:void(0);" target="_self">'.$i.'</a></li>';
				}else{
					$str_pagetxt .= '<li><a href="'.$this->getUrl($i).'">'.$i.'</a></li>';
				}
			}
			
			if ($int_end_page<$this->int_page_total){
				$str_pagetxt .= '<li class="disabled"><a  title="末页" target="_self">...'.$this->int_page_total.'</a></li>';
			}
		}
		return $str_pagetxt;
	}
	
	/*
	 * 得到当前的url生成对应的URL
	 * 
	 */
	public function getUrl($int_page=0) {
		$str_url = '';
		if ($this->int_type==1){
			$str_url = $this->getUrlParam($int_page);
		}else{
			$str_url = $this->getUrlRewrite($int_page);
		}
		return $str_url;
	}
	/*
	 * 得到传统链接形式的URL
	 */
	public function getUrlParam($int_page=0){
		$str_url = $_SERVER ["REQUEST_URI"];
		$str_parse_url = parse_url ( $str_url );
		$str_url_query = isset($str_parse_url["query"])?$str_parse_url ["query"]:''; //单独取出URL的查询字串
		if ($str_url_query) {
			//因为URL中可能包含了页码信息，我们要把它去掉，以便加入新的页码信息。
			//这里用到了正则表达式，请参考“PHP中的正规表达式”
			$str_url_query = preg_replace ( "/^$this->str_page_var=\d+&/", "", $str_url_query );//替换url参数以分页参数开头的url参数
			$str_url_query = preg_replace ( "/(^|&)$this->str_page_var=\d+/", "", $str_url_query );
			
			//将处理后的URL的查询字串替换原来的URL的查询字串：
			$str_url = str_replace ( $str_parse_url ["query"], $str_url_query, $str_url );
			
			//在URL后加page查询信息，但待赋值：
			if ($str_url_query)
				$str_url .= "&$this->str_page_var=";
			else
				$str_url .= "$this->str_page_var=";
		} else {
			$str_url .= "?$this->str_page_var=";
		}
		
		if (!empty($int_page) && $int_page!='' && $int_page!=0){
			$str_url = $str_url.$int_page;
		}
		return $str_url;
	}
	
	/*
	 * 得到urlrewrite以后的URL
	 */
	public function getUrlRewrite($int_page=0){
		$str_url = $_SERVER ["REQUEST_URI"];
		
		if ($str_url) {
			//因为URL中可能包含了页码信息，我们要把它去掉，以便加入新的页码信息。
			//这里用到了正则表达式，请参考“PHP中的正规表达式”
			if (!empty(Yii::app()->urlManager->urlSuffix)){
				$str_url = preg_replace ( "/".Yii::app()->urlManager->urlSuffix."/", "", $str_url );
			}
			$str_url = preg_replace ( "/\/$/", "", $str_url );
			$str_url = preg_replace ( "/\/$this->str_page_var\/\d+/", "", $str_url );
			
			
			if (!strstr(strtolower($str_url), strtolower($this->str_default_url))){
				$str_url = $this->str_default_url;
			}
			
			//在URL后加page查询信息，但待赋值：
			if ($str_url){
				$str_url .= "/$this->str_page_var/";
			}else{
				$str_url .= "/$this->str_page_var/";
			}
		} else {
			if (!strstr(strtolower($str_url), strtolower($this->str_default_url))){
				$str_url = $this->str_default_url;
			}
			$str_url .= "/$this->str_page_var/";
		}
		if (!empty($int_page) && $int_page!='' && $int_page!=0){
			$str_url = $str_url.$int_page.Yii::app()->urlManager->urlSuffix;
		}		
		return $str_url;
	}
	
}

?>
