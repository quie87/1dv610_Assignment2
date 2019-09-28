<?php

namespace model;

class Cookie {
    private static $COOKIE_NAME =  __CLASS__ .  "::UserName";
    private static $COOKIE_PASSWORD =  __CLASS__ .  "::UserPassword";

    public function userHasCookie() : bool {
        return isset($_COOKIE[self::$COOKIE_NAME]) && isset($_COOKIE[self::$COOKIE_PASSWORD]);
    }

    public function getUserByCookie() {
        $username = $_COOKIE[self::$COOKIE_NAME];
        $pass = $_COOKIE[self::$COOKIE_PASSWORD];
        return new \model\UserModel($username, $pass, true);
    }
    
    public function saveCookie($credentials) {
        $name = $credentials->getUserName();
        $password = $credentials->getUserPassword();
        $int = 3600;

        setCookie(self::$COOKIE_NAME, $name, time()+$int);
        setCookie(self::$COOKIE_PASSWORD, $password, time()+$int);
    }

    public function removeCookie () {
        setCookie(self::$COOKIE_NAME, "", time() -4000);
        setCookie(self::$COOKIE_PASSWORD, "", time() -4000);
    }
}