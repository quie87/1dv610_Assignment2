<?php

namespace model;

class Cookie {
    private static $COOKIE_NAME =  __CLASS__ .  "::UserName";
    private static $COOKIE_PASSWORD =  __CLASS__ .  "::UserPassword";
    // cookie password
    public function __construct()
    {
        
    }

    public function userHasCookie() : bool {
        // TODO: Check if there is a cookie, if so, return true
        return false;
    }

    public function getUserByCookie() {
        // TODO: Get the user credentials from the cookie. Return user object
        return true;
    }
    
    public function saveCookie($credentials) {
        $name = $credentials->getUserName();
        $password = $credentials->getUserPassword();
        $int = 3600;

        setCookie($name, $password, time()+$int);
    }

    public function setCookiTimer() {
        throw new \Exception('Not implemented yet');
    }

    public function removeCookie () {
        setCookie([self::$COOKIE_NAME], [self::$COOKIE_PASSWORD], time()-4000);
    }
}