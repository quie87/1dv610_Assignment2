<?php

namespace view;

class DateTimeView 
{
	public function show() : string {
		$weekDay = date('l');
		$date = date('jS');
		$month = date('F');
		$year = date('Y');
		$currentTime = date('H:i:s');

		$timeString = "${weekDay}, the ${date} of ${month} ${year}, The time is ${currentTime}";

		return '<p>' . $timeString . '</p>';
	}
}