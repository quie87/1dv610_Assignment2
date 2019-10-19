<?php

namespace view;

class RegisterView {
    private static $name =  'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $register = 'RegisterView::Register';
	private static $messageId = 'RegisterView::Message';
	
	private $message;
	private $previusUserNameInput;
    
	public function userWantToRegister() : bool {
		if ($this->hasUserClickedRegister()) {
			$this->checkForEmptyFields();
			$this->previusUserNameInput = $this->getNewUsername();
		}
		
		if ($this->hasUserClickedRegister() && $this->hasUsername() && $this->hasPassword() && $this->hasPasswordRepeat()) {
			return true;
		} else {
			return false;
		}
	}

	private function hasUserClickedRegister() {
		return isset($_POST[self::$register]);
	}

	private function checkForEmptyFields () {
		if(!$this->hasUsername() && !$this->hasPassword()) {
			$this->setMessage("Username has too few characters, at least 3 characters. <br> Password has too few characters, at least 6 characters.");
		} else if (!$this->hasUsername()) {
			$this->setMessage("Username has too few characters, at least 3 characters.");
		} else if (!$this->hasPassword()) {
			$this->setMessage("Password has too few characters, at least 6 characters.");
		} else if (!$this->hasPasswordRepeat()) {
			$this->setMessage("Password has too few characters, at least 6 characters.");
		}
		return;
	}

	private function hasUsername () : bool {
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
	}
	private function hasPassword () : bool {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
	}
	private function hasPasswordRepeat () : bool {
		return isset($_POST[self::$passwordRepeat]) && !empty($_POST[self::$passwordRepeat]);
	}
	
	public function setMessage($message) {
		$this->message = $message;
	}
	
	
	public function getRegisterCredentials () : \model\RegistrationModel {
		if ($this->hasUsername() && $this->hasPassword() && $this->hasPasswordRepeat()) {
			$user = $this->getNewUsername();
			$password = $this->getNewUserPassword();
			$passwordRepeat = $this->getNewPasswordRepeat();
			
			return new \model\RegistrationModel($user, $password, $passwordRepeat);
		}
	}
	
	public function getNewUserName() {
		return ($_POST[self::$name]);
	}
	
	public function getNewUserPassword() {
		return ($_POST[self::$password]);
	}
	
	public function getNewPasswordRepeat() {
		return ($_POST[self::$passwordRepeat]);
	}

	public function succesfulRegistration() {
		// TODO: Find a way to give the message to the loginView
		// $this->loginView->setMessage('Registered new user.');
		header('Location: ./');
	}
	
	public function userNavigatesToRegister() : bool {
		if (isset($_GET['register'])) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Create HTTP response
	 *
	 * Should be called after a registration attempt has been determined
	 *
	 * @return void BUT writes to standard output!
	 */
	public function response($isLoggedin) {
		$response = $this->generateRegistrationFormHTML($this->message);
		$response .= $this->renderNavigationLink($isLoggedin);
		
		return $response;
	}
	
	/**
	* Generate HTML code on the output buffer for the Registration form
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
    private function generateRegistrationFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Register - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->previusUserNameInput .'" />
					previous

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                    
                    <label for="' . self::$passwordRepeat . '">Repeat Password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
					
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
	}
	
	private function renderNavigationLink($isLoggedIn) {
		$ret = '';

		if (!$isLoggedIn && $this->userNavigatesToRegister()){ 
		$ret = '<a href="./">Back to login</a>';
		}
		return $ret;
	}
}