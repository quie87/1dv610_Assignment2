<?php

class DateTimeView {

	public function show() {
		return '<p>' . DateTimeModel::getCurrentTime() . '</p>';
	}
}