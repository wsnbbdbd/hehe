<?php
class EncryptController extends CController {
	
	
	public function actionEncrypt(){
		$keyStr = 'UITN25LMUQC436IM';
		$plainText = 'this is a string will be AES_Encrypt';
		 
		$aes = new CryptAES();
		$aes->set_key($keyStr);
		$aes->require_pkcs5();
		$encText = $aes->encrypt($plainText);
		$decString = $aes->decrypt($encText);
		 
		echo $encText,"<br/>",$decString;
		
		/*$obj_encrypt = new Encrypt("#$!@#12312312");
		$str = "<Header>" .
				"<TaskGUID/>" . 
				"<TaskCurrentGUID/>" .
				"<TaskPreStepGUID/>" . 
				"<UserToken>zcy</UserToken>" .
				"<SourceSystemID>ML_TEST</SourceSystemID>" . 
				"</Header>";
		
		echo $obj_encrypt->encrypt($str);*/
	}
	public function actionDecrypt(){
		$obj_encrypt = new Encrypt($key = "#$!@#12312312");
		$str_decode = 'BG9UGAkyVGdUY1AzAnZSbFdrVwRQZQ1wBGZSQAAHVRRUR1N4WzsDbQAHAGdbLlc8UhFWJFJ0DHAH
awU+AyUHSAQGVBkJE1QpVDlQagJQUjNXJFc7UFQNcQRoUlQAJlU4VHNTEFtQAxgAFwApW2NXa1IH
ViJSYwxwB1oFPwM6B2oEPVRuCS1UZVR+UGoCK1IHVyRXNVB2DVcEYlJsADdVM1Q9U2tbVgM+ACYA
dFs+VzJSAVYoUnUMdgdrBT0DGAdLBG1UHQkbVFlUU1ATAldSBldrV39QVw1sBHhSdQAxVThUUFMu
W3YDJQA2AGtbFFcTUmxWbVIpDEoHawUxAzUHagQhVG4=';
		echo $obj_encrypt->decrypt($str_decode);
	}
}