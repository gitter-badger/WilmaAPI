<?php
class Wilma {
	private $ch;
	private $sessionkey;
	private $url;

	function __construct($urll) {
		$this->url = $urll;
	}

	private function abort($s) {
		die('<b>[WilmaAPI] Error:</b> ' . $s);
	}

	public function connect() {
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($this->ch, CURLOPT_COOKIESESSION, 1);
		curl_setopt($this->ch, CURLOPT_COOKIEJAR, "cookie.txt");
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
		curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($this->ch, CURLOPT_POST, 0);
		curl_setopt($this->ch, CURLOPT_URL, "https://" . $this->url . "/login?returnpath=forms");
		if($c = preg_match_all("/<input type=\"hidden\" name=\"SESSIONID\" value=\"(.*?)\">/", curl_exec($this->ch), $matches)) {
		    $this->sessionkey = $matches[1][0];
		}
		if(empty($this->sessionkey) || !isset($this->sessionkey)) {
			$this->abort("Session key not found.");
		}
	}

	public function login($username, $password) {
		curl_setopt($this->ch, CURLOPT_URL, "https://".$this->url."/login");
		curl_setopt($this->ch, CURLOPT_POST, 1);
		curl_setopt($this->ch, CURLOPT_POSTFIELDS, 'Login='.$username.'&Password='.$password.'&SESSIONID='.$this->sessionkey);
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
		curl_exec($this->ch);
	}

	public function getPage($page) {
		curl_setopt($this->ch, CURLOPT_URL, 'https://'.$this->url . $page);
		curl_setopt($this->ch, CURLOPT_COOKIEFILE, "cookie.txt");
		return curl_exec($this->ch);
	}

	public function end() {
		curl_close($this->ch);
	}
}
