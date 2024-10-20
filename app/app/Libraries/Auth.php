<?php

namespace App\Libraries;

class Auth
{
    public static function setAuth($user)
    {
        $session = session();
        $session->set("userdata", $user);
        $session->set(["logged_in" => true]);
    }

    public static function getId()
    {
        $session = session();
        $userData = $session->get('userdata');
        return isset($userData['id']) ? $userData['id'] : null;
    }

    public static function isLoggedIn()
    {
        return Auth::getId() !== null;
    }

    public static function logout()
    {
        $session = session();
        $session->remove("logged_in");
        $session->remove("userdata");
        //  $session->destroy(); 
    }
    public static function user()
    {
        $session = session();
        return $session->has("userdata") ? $session->get("userdata") : null;
    }

    public static function isAdmin()
    {
        return !Auth::isLoggedIn() ? false  : (Auth::user()['role'] == "ADMIN" ? true : false);
    }
}
