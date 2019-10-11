<?php

class DateTimeModel {
    public static function getCurrentTime () : string {
		
		$weekDay = date('l');
		$date = date('jS');
		$month = date('F');
		$year = date('Y');
		$currentTime = date('H:i:s');

		return "${weekDay}, the ${date} of ${month} ${year}, The time is ${currentTime}";
	}
}