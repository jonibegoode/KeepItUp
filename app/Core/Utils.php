<?php
namespace Core;

class Utils {

	public static function debug($array) {
		echo '<pre>'.print_r($array, true).'</pre>';
	}

	/*
		Transforme une chaîne du type "setCreation_date" en "setCreationDate"
	*/
	public static function getCamelCase($str) {
		return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $str))));
	}


	public static function redirectJS($url, $delay = 1) {
	    echo '<script>
	          setTimeout(function() {
	                location.href = "'.$url.'"; }
	          , '.($delay * 1000).');
	          </script>';
	}

	public static function cutString($text, $max_length = 0, $end = '...', $sep = '[@]') {

	    if ($max_length > 0 && strlen($text) > $max_length) {
	        $text = wordwrap($text, $max_length, $sep);
	        $text = explode($sep, $text);
	        return $text[0].$end;
	    }

	    return $text;
	}

	public static function formatAmount($amount, $currency = '&euro;') {
	    return number_format($amount, 2, ',', '&nbsp;').' '.$currency;
	}

}