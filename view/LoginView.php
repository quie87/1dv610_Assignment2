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
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	public function __construct() {}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		$message = '';
		
		$response = $this->generateLoginFormHTML($message);
		
		//$response .= $this->generateLogoutButtonHTML($message);
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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	
	public function userWantToLogIn() : bool {
		return isset($_POST[self::$name]);
	}

	public function getUserName() {
		return \model\UserModel::applyFilter($_POST[self::$name]);
		// return \Model\UserModel($this->getInputValueFiltered());
	}

	public function getUserPassword() {
		return ($_POST[self::$password]);
	}

	public function getUserKeep() {
		return ($_POST[self::$keep]);
		// if ($_POST[self::$keep]) {
		// 	return true;
		// } else {
		// 	return false;
		// }
	}

	public function setMessage() {
		throw new Exception('Not implemented yet');
	}


	public function getInputValueFiltered() : string {
			return \Model\UserModel::applyFilter($_POST[self::$name]);
		
		// if ($this->userWantToLogIn()) {
		// 	$inputValue = $_GET[self::$name];
		// 	return \model\UserModel::applyFilter($inputValue);
		// }
		// return "";
	}

	private function logErrorMessage() {
		throw new Exception('Not implemented yet');
	}
}