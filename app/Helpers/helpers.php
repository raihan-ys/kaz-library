<?php

use Carbon\Carbon;

if(!function_exists('formatRp')) {
	function formatRp($number, $decimal = 2)
	{
		try {
			return 'Rp ' . number_format($number, $decimal, ',', '.');
		} catch (\Exception $e) {
			return 'Rp 0, 00';
		}
	}
}

if(!function_exists('formatDate')) {
	function formatDate($date, $format = 'd F Y')
	{
		try {
			return Carbon::parse($date)->translatedFormat($format);
		} catch (\Exception $e) {
			return null;
		}
	}
}

?>