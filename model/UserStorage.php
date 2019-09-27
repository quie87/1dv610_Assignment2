<?php

namespace model;

class UserStorage {
	private static $SESSION_KEY =  __CLASS__ .  "::UserName";

	public function loadUser() {
		if (isset($_SESSION[self::$SESSION_KEY])) {
			return $_SESSION[self::$SESSION_KEY];
		} else {
			return false;
		}
	}
	public function saveUser(UserModel $toBeSaved) {
		$_SESSION[self::$SESSION_KEY] = $toBeSaved;
	}

	public function destroySession() {
		unset($_SESSION[self::$SESSION_KEY]);
	}

	public function isLoggedin() {
		if (isset($_SESSION[self::$SESSION_KEY])) {
			return $_SESSION[self::$SESSION_KEY];
		}
	}

	public function userHasSession() {
		throw new \Exception('Not implemented yet');
	}
}