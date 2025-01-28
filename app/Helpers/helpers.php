<?php

use Carbon\Carbon;

// Format the number to Indonesian currency.
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

// Format the date to Indonesian date.
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