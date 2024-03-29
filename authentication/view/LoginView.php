<?php

namespace view;

class LoginView 
{
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
	
	public function userWantToLogIn() : bool 
	{
		if ($this->userClickedLogin()) {
			$this->checkForEmptyFields();
			$this->oldUserName = $this->getUsername();
		}
		
		if ($this->userClickedLogin() && $this->hasUsername() && $this->hasPassword()) {
			return true;
		} else {
			return false;
		}
	}

	private function userClickedLogin() 
	{
		return isset($_POST[self::$login]);
	}
	
	private function checkForEmptyFields () 
	{
		if (!$this->hasUsername()) {
			$this->setMessage("Username is missing");
		} else if (!$this->hasPassword()) {
			$this->setMessage("Password is missing");
		}

		return;
	}

	private function hasUsername () : bool 
	{
		return isset($_POST[self::$name]) && !empty($_POST[self::$name]);
	}

	private function hasPassword () : bool 
	{
		return isset($_POST[self::$password]) && !empty($_POST[self::$password]);
	}

	public function setMessage($message) 
	{
		$this->message = $message;
	}
	
	public function userWantToLogout() : bool 
	{
		if ($this->userClickedLogout()) {
			return true;
		} else {
			return false;
		}
	}

	private function userClickedLogout() : bool
	{
		return isset($_POST[self::$logout]);
	}
	
	public function getUserCredentials () : \model\UserModel 
	{
		if ($this->hasUsername() && $this->hasPassword()) {
			$name = $this->getUsername();
			$pass = $this->getUserPassword();
			$stayLoggedIn = $this->getStayLoggedIn();

			return new \model\UserModel($name, $pass, $stayLoggedIn);
		}
	}

	public function getUserName() : string
	{
		return ($_POST[self::$name]);
	}

	public function getUserPassword() : string 
	{
		return ($_POST[self::$password]);
	}

	public function getStayLoggedIn() : bool 
	{
		return isset($_POST[self::$stayLoggedIn]);
	}

	public function userHasCookie() : bool 
	{
        return isset($_COOKIE[self::$cookieName]) && isset($_COOKIE[self::$cookiePassword]);
    }

	public function getUserByCookie() : \model\UserModel 
	{
        $username = $_COOKIE[self::$cookieName];
		$password = $_COOKIE[self::$cookiePassword];
		
        return new \model\UserModel($username, $password, true);
    }
    
	public function saveCookie($credentials) 
	{
        $name = $credentials->getUserName();
        $password = $credentials->getUserPassword();
        $int = 3600;

        setCookie(self::$cookieName, $name, time()+$int);
        setCookie(self::$cookiePassword, $password, time()+$int);
    }

	public function removeCookie () 
	{
        setCookie(self::$cookieName, "", time() -4000);
        setCookie(self::$cookiePassword, "", time() -4000);
	}

	public function userNavigatesToRegister() : bool 
	{
		if (isset($_GET['register'])) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Create HTTP response
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output
	 */
	public function response($isLoggedin) 
	{
		if(!$isLoggedin) {
			$response = $this->generateLoginFormHTML($this->message);
		} else {
			$response = $this->generateLogoutButtonHTML($this->message);
		}
		
		$response .=$this->renderNavigationLink($isLoggedin);
		return $response;
	}

	private function generateLogoutButtonHTML($message) 
	{
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}

	private function generateLoginFormHTML($message) 
	{
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

	private function renderNavigationLink($isLoggedIn) 
	{
		$ret = '';

		if (!$isLoggedIn && !$this->userNavigatesToRegister()) {
			$ret = '<a href="?register">Register a new user</a>';
		} 

		return $ret;
	}
}