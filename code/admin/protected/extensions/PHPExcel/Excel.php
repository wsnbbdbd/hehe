<?php
/**
 * Excel表 导入 导出
 * 
 * @author zhaozhe
 * @version 1.0
 */
class Excel{
	/**
	 * 构造方法 自动加载
	 */
	public function Excel(){
		include 'PHPExcel.php';
		include 'PHPExcel/Writer/Excel5.php';
		include 'PHPExcel/IOFactory.php';
		include 'PHPExcel/Reader/Excel5.php';
	}
	
	/**
	 * 导出Excel表
	 * 
	 * @param Array $arr_field	字段名
	 * @param Array $arr_list	数据
	 * @param String $str_fileName 文件名
	 */
	public function export($arr_field,$arr_list,$str_fileName){
		$objExcel = new PHPExcel();
		$objWriter = new PHPExcel_Writer_Excel5($objExcel);
		
		/**
		 * 计算数组 长度
		 * @var $arr_list
		 * @var $arr_field
		 */
		$countList=count($arr_list);
		$countField=count($arr_field);
		$abc=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

		
		/**
		 * 设置基本属性
		 */
		$objProps = $objExcel->getProperties();
		$objProps->setCreator("Maarten Balliauw");
		$objProps->setLastModifiedBy("Maarten Balliauw");
		$objProps->setTitle("Office 2003 XLS Test Document");
		$objProps->setSubject("Office 2003 XLS Test Document");
		$objProps->setDescription("Test document for Office 2003 XLS, generated using PHP classes.");
		$objProps->setKeywords("office excel PHPExcel");
		$objProps->setCategory("Students");
		$objExcel->setActiveSheetIndex(0);
		$objActSheet = $objExcel->getActiveSheet();
		
		/**
		 * 设置当前活动sheet的名称
		 */
		$objActSheet->setTitle($str_fileName);
		
		/**
		 * 设置宽度
		 */
		$objActSheet->getColumnDimension('B')->setWidth(15);
		$objActSheet->getColumnDimension('C')->setWidth(35); 
		$objActSheet->getColumnDimension('D')->setWidth(15); 
		$objActSheet->getColumnDimension('E')->setWidth(50); 
		$objActSheet->getColumnDimension('F')->setWidth(50);

		/**
		 * 设置字体
		 */
		$objFont = $objActSheet->getStyle('A1:'.$abc[$countField-1].'1')->getFont();
		$objFont->setSize(12);  
		$objFont->setBold(true);  
		
		/**
		 * 设置对齐方式
		 */
		$objAlign = $objActSheet->getStyle('A1:'.$abc[$countField-1].'1')->getAlignment();  
		$objAlign->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);  
		$objAlign->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
		
		
		for($i=0;$i<$countField;$i++){
			$objActSheet->setCellValue($abc[$i].'1',$arr_field[$i]);
		}
		
		/**
		 * 设置单元格内容
		 */
		for($i=0;$i<$countList;$i++){
			for($o=0;$o<$countField;$o++){
				$objCell = $objActSheet->getStyle($abc[$o].($i+2));
				/**
				 * 设置对齐方式
				 */
				$objAlign2 = $objCell->getAlignment();  
				$objAlign2->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
				$objAlign2->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$objActSheet->setCellValue($abc[$o].($i+2),$arr_list[$i][$o]);
			}
		}
		$outputFileName = $str_fileName;
		
		/**
		 * 设置字符编码集
		 */
		//$content = iconv("UTF-8", "GBK", $outputFileName); 
		$outputFileName = mb_convert_encoding($outputFileName, "gb2312", "UTF-8");
		header('Content-Type : application/vnd.ms-excel');
		/**
		 * 产生文件
		 */
        header('Content-Disposition:attachment;filename="'.$outputFileName.'.xls"');
        /**
         * 输出
         */
        $objWriter->save('php://output');
		
	}
		
	/**
	 * 导入数据
	 * 
	 * @param String $uploadfile 导入数据的地址
	 * @return 返回一个数组
	 */
		public function importing($uploadfile){
			$objReader =new PHPExcel_Reader_Excel5();
			
			/**
			 *加载文件 
			 */
			$objPHPExcel=$objReader->load($uploadfile);
			
			/**
			 * 设置从0开始
			 */
			$sheet = $objPHPExcel->getSheet(0);
			
			/**
			 * 获取行
			 */
			$highestRow = $sheet->getHighestRow();
			
			/**
			 * 获取列
			 */
			$highestColumn = $sheet->getHighestColumn();
			
			/**
			 * 转化列为数
			 */
			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
			$list=array();
			
			
			/**
			 * 循环遍历 组成数组
			 */
			for($i=1;$i<$highestColumnIndex;$i++){
				for($o=0;$o<=$highestRow;$o++){
					$value=$sheet->getCellByColumnAndRow($o,$i)->getValue();
					$list[$i][$o]=$value;
				}
			}
			return $list;
		}
}

?>