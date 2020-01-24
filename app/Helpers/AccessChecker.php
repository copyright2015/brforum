<?php


namespace App\Helpers;

use Auth;
use App\User;

class AccessChecker
{
    public static function check()
    {
        $allowed = false;
        if(Auth::check()) {
            $roles = Auth::user()->roles()->get();
            foreach ($roles as $role) {
                if ($role->name == "Admin" || $role->name == "Mod" || $role->name == "Global_mod") {
                    $allowed = true;
                }
            }
        }
        return $allowed;
    }
    public static function isAdmin()
    {
        if(Auth::check()) {
            $roles = Auth::user()->roles()->get();
            foreach ($roles as $role) {
                if ($role->name == "Admin") {
                    return true;
                }
            }
        }
        return false;
    }
    public static function isMod()
    {
        if(Auth::check()) {
            $roles = Auth::user()->roles()->get();
            foreach ($roles as $role) {
                if ($role->name == "Mod") {
                    return true;
                }
            }
        }
        return false;
    }
    public static function isGlobal_mod()
    {
        if(Auth::check()) {
            $roles = Auth::user()->roles()->get();
            foreach ($roles as $role) {
                if ($role->name == "Global_mod") {
                    return true;
                }
            }
        }
        return false;
    }

    public static function checkUser(User $user)
    {
        $allowed = false;
            $roles = $user->roles()->get();
            foreach ($roles as $role) {
                if ($role->name == "Admin" || $role->name == "Mod" || $role->name == "Global_mod") {
                    $allowed = true;
                }
            }
        return $allowed;
    }
}
