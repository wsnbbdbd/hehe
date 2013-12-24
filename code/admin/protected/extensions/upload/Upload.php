<?php
class Upload{
	public function UpdateImage($file,$dirName='good'){
		$retValue = ""; 
		$targetFolder = '/uploads';
		 
        if($file == null){  
            $retValue = array(
            	'code'=> -1,
                'msg' =>"提示：不能上传空文件。"
            );  
        }else if($file->size > 2000000){  
            $retValue = array(
            	'code'=> -2,
                'msg' =>"提示：文件大小不能超过2M。"
            );  
        }else {  
            $retValue = '恭喜，上传成功！';
        	// Validate the file type
			$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
			$fileParts = pathinfo($file);
			if (!empty($fileParts['extension']) && in_array(strtolower($fileParts['extension']),$fileTypes)) {
	       		$uploadDir=Yii::app()->basePath.'/../uploads/'.$dirName.'/'.date('Y-m',time());
	       		//$uploadDir='/home/www/CenterTradingManageSystem/uploads/'.$dirName.'/'.date('Y-m',time());
				self::recursionMkDir($uploadDir);
				$imgname=time().'-'.rand().'.'.$file->extensionName;
				//图片存储路径
				//$imageurl='http://'.$_SERVER['HTTP_HOST'].'/uploads/'.$dirName.'/'.date('Y-m',time()).'/'.$imgname;
				$imageurl='/uploads/'.$dirName.'/'.date('Y-m',time()).'/'.$imgname;
				//存储绝对路径
				$uploadPath=$uploadDir.'/'.$imgname;
				if($file->saveAs($uploadPath)){
					$retValue = array(
		            	'code'=> 1,
		                'msg' =>"文件上传成功",
						'img' => $imageurl
		            );  			
				}
			}else{
				 $retValue = array(
	            	'code'=> -3,
	                'msg' =>"文件类型非法。"
	            );  
			}
        }
        return $retValue;
	}
	private static function recursionMkDir($dir){
		if(!is_dir($dir)){
			if(!is_dir(dirname($dir))){
				self::recursionMkDir(dirname($dir));
				mkdir($dir,'0755');
			}else{
				mkdir($dir,'0755');
			}
		}
	}
}