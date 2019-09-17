<?php

class DateTimeView {

	public function getCurrentTime () : string {
		$currentTime = new DateTime();
		$currentTime = $currentTime->format('Y/m/d s:i:H');

		return $currentTime;
	}

	public function show() {
		return '<p>'. 'Date: ' . $this->getCurrentTime() . '</p>';
	}
}