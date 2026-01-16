<?php
namespace app\admin\controller;

class Code
{
	public function getTopDomainhuo()
	{
		error_reporting(0);
		$host = $_SERVER["HTTP_HOST"];
		$matchstr = "[^\\.]+\\.(?:(" . $host . ")|\\w{2}|((" . $host . ")\\.\\w{2}))\$";
		if (preg_match("/" . $matchstr . "/ies", $host, $matchs)) {
			$domain = $matchs[0];
		} else {
			$domain = $host;
		}
		return $domain;
	}
	public function domain()
	{
		return true;
	}
}