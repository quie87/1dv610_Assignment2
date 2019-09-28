<?php

namespace view;

class RegistrationView {
    private static $name = 'RegistrationView::UserName';
	private static $password = 'RegistrationView::Password';
	private static $repeatPassword = 'RegistrationView::RepeatPassword';
	private static $register = 'RegistrationView::Register';
	private static $login = 'RegistrationView::Login';
	private static $messageId = 'RegistrationView::Message';
	
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
                    
                    <label for="' . self::$repeatPassword . '">Repeat Password :</label>
					<input type="password" id="' . self::$repeatPassword . '" name="' . self::$repeatPassword . '" />
					
					<input type="submit" name="' . self::$register . '" value="Register" />

					<br /><br />
					<input type="submit" name="' . self::$login . '" value="Back to login page" />
				</fieldset>
			</form>
		';
	}
}