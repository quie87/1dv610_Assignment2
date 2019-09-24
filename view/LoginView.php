<?php

namespace view;

use Exception;

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $stayLoggedIn = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';
	
	private $oldUserName;
	private $message;

	public function __construct() {}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response($isLoggedin) {
		if(!$isLoggedin) {
			$response = $this->generateLoginFormHTML($this->message);
		} else {
			$response = $this->generateLogoutButtonHTML($this->message);
		}
		
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the Login form
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->oldUserName .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$stayLoggedIn . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$stayLoggedIn . '" name="' . self::$stayLoggedIn . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function userWantToLogIn() : bool {
		if ($this->userClickedLogin()) {
			$this->checkForEmptyFields();
		}
		//else check if user tries to register
		
		if ($this->userClickedLogin() && $this->hasUsername() && $this->hasPassword()) {
			return true;
		} else {
			return false;
		}
	}

	public function getUserName() {
		return ($_POST[self::$name]);
	}

	public function getUserPassword() {
		return ($_POST[self::$password]);
	}

	public function getStayLoggedIn() : bool {
		return isset($_POST[self::$stayLoggedIn]);
	}

	private function hasUsername () : bool {
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
	}
	private function hasPassword () : bool {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
	}

	private function userClickedLogin() {
		return isset($_POST[self::$login]);
	}

	private function checkForEmptyFields () {
		if (!$this->hasUsername()) {
			$this->setMessage("Username is missing");
		} else if (!$this->hasPassword()) {
			$this->oldUserName = $this->getUsername();
			$this->setMessage("Password is missing");
		}
		return;
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function getUserCredentials () : \model\UserModel {
		if ($this->hasUsername() && $this->hasPassword()) {
			$name = $this->getUsername();
			$pass = $this->getUserPassword();
			$stayLoggedIn = $this->getStayLoggedIn();

			return new \model\UserModel($name, $pass, $stayLoggedIn);
		}
	}

	// public function getInputValueFiltered() : string {
			// return \Model\UserModel::applyFilter($_POST[self::$name]);
		
		// if ($this->userWantToLogIn()) {
		// 	$inputValue = $_GET[self::$name];
		// 	return \model\UserModel::applyFilter($inputValue);
		// }
		// return "";
	// }

}