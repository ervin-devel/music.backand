<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

function userCheckAccess(string $access): bool
{
    if (!Auth::check()) {
        return false;
    }
    $accesses = Auth::user()
        ->role
        ->accesses()
        ->select('slug')
        ->get()
        ->pluck('slug')
        ->toArray();

    return in_array($access, $accesses);
}

function isActiveNavLink(string|array $routeNames, string $class = null)
{

    $currentRouteName = Route::currentRouteName();

    if (is_array($routeNames)) {
        if (in_array($currentRouteName,$routeNames)) {
            if ($class) {
                return $class;
            }
            return true;
        } else {
            return false;
        }
    }

    if ($currentRouteName === $routeNames) {
        if ($class) {
            return $class;
        }
        return true;
    } else {
        return false;
    }
}
