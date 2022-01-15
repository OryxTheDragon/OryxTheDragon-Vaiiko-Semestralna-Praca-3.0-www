<?php

namespace Classes;
abstract class Redirektor
{
    public static function navratDomov()
    {
        Header("Location:home.php");
    }

    public static function registracia()
    {
        Header("Location:registracia.php");
    }

    public static function prihlasenie()
    {
        Header("Location:prihlasit.php");
    }

    public static function tvorbaCharakteru()
    {
        Header("Location:vytvorCharakter.php");
    }

    public static function redirectZmenaHesla()
    {
        Header("Location:zmenaHesla.php");
    }

    public static function redirectPremenovanie()
    {
        Header("Location:premenovanie.php");
    }

    public static function redirectTvorbaCharaktera()
    {
        Header("Location:vytvorCharakter.php");
    }

    public static function redirectNastavenia()
    {
        Header("Location:profiloveNastavenia.php");
    }
}