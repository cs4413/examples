<?php
class Site {
	public static function getHTTPReturnCode($ip) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $ip);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$tmp = curl_exec($ch);
		$info = curl_getinfo($ch);
		
		if (isset($info['http_code']))
			$ret = $info['http_code'];
		else
			$ret= '401';
		curl_close($ch);
		return $ret;
	}
}
?>