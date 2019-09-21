<?php

class DateTimeModel {
    public static function getCurrentTime () : string {
		
		$weekDay = date('l');
		$date = date('d');
		$month = date('F');
		$year = date('Y');
		$hour = date('G');
		$minutes = date('i');
		$seconds = date('s');

		return "${weekDay}, the ${date}th of ${month} ${year}, The time is ${hour}:${minutes}:${seconds}";
	}
}