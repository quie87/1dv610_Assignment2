<?php

namespace model;

class Cookie {
    // cookie name
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
        setCookie("name", "value", time()+$int);
    }

    public function removeCookie () {
        // TODO: Remove the cookie ofc
        throw new \Exception('Not implemented yet');
    }
}