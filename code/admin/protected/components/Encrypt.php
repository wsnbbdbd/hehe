<?php
class Encrypt
{
	private $key;
	
	public function __construct($key)
	{
		$this->key = $key;
	}
	
	private function keyED($txt) { 
		$encrypt_key = md5($this->key); 
		$ctr=0; 
		$tmp = ""; 
		for ($i=0;$i<strlen($txt);$i++){ 
			if ($ctr==strlen($encrypt_key)){ $ctr=0;} 
			$tmp.= substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1); 
			$ctr++; 
		}
		return $tmp; 
	}
	public function encrypt($txt){ 
		srand((double)microtime()*1000000); 
		$encrypt_key = md5(rand(0,32000)); 
		$ctr=0; 
		$tmp = ""; 
		for ($i=0;$i<strlen($txt);$i++){ 
			if ($ctr==strlen($encrypt_key)){ $ctr=0; }
			$bbb=substr($encrypt_key,$ctr,1) . 
			(substr($txt,$i,1) ^ substr($encrypt_key,$ctr,1));
			$tmp.= $bbb; 
			$ctr++; 
		}
		return base64_encode($this->keyED($tmp)); 
	}
	public function  decrypt($txt){ 
		$txt=base64_decode($txt);
		$txt = $this->keyED($txt); 
		$tmp = ""; 
		for ($i=0;$i<strlen($txt);$i++){ 
			$md5 = substr($txt,$i,1); 
			$i++; 
			$tmp.= (substr($txt,$i,1) ^ $md5); 
		} 
		return $tmp; 
	}
}