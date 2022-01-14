<?php


namespace Classes;
abstract class Authenticator
{
    public static function login($username)
    {
        $_SESSION['username'] = $username;
    }

    public static function logout()
    {
        unset($_SESSION['username']);
    }

    public static function isLogged()
    {
        return isset($_SESSION['username']);
    }

    public static function getName()
    {
        return (Authenticator::isLogged() ? $_SESSION['username'] : "Anon");
    }
}