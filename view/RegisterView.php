<?php

namespace view;

class RegisterView {
    private static $name = 'RegisterView::UserName';
	private static $password = 'RegisterView::Password';
	private static $passwordRepeat = 'RegisterView::PasswordRepeat';
	private static $register = 'RegisterView::Register';
	private static $messageId = 'RegisterView::Message';
	
	private $message;
	private $oldUserName;

    /**
	 * Create HTTP response
	 *
	 * Should be called after a registration attempt has been determined
	 *
	 * @return void BUT writes to standard output!
	 */
	public function response() {
        $response = $this->generateRegistrationFormHTML($this->message);
		
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
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->oldUserName .'" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />
                    
                    <label for="' . self::$passwordRepeat . '">Repeat Password :</label>
					<input type="password" id="' . self::$passwordRepeat . '" name="' . self::$passwordRepeat . '" />
					
					<input type="submit" name="' . self::$register . '" value="Register" />
				</fieldset>
			</form>
		';
	}

	public function getNewUserName() {
		return ($_POST[self::$name]);
	}

	public function getNewUserPassword() {
		return ($_POST[self::$password]);
	}

	public function getNewPasswordRepeat() : bool {
		return isset($_POST[self::$passwordRepeat]);
	}

	private function hasUsername () : bool {
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
	}
	private function hasPassword () : bool {
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
	}
	private function hasRepeatPassword () : bool {
		return isset($_POST[self::$repeatPassword]) && !empty($_POST[self::$repeatPassword]);
	}

	public function setMessage($message) {
		$this->message = $message;
	}

	public function getRegisterCredentials () : \model\RegistrationModel {
		if ($this->hasUsername() && $this->hasPassword() && $this->hasRepeatPassword()) {
				$user = $this->getUsername();
				$password = $this->getUserPassword();
				$repeatPassword = $this->getPasswordRepeat();
			
			return new \model\RegistrationModel($user, $password, $repeatPassword);
		}
	}
}