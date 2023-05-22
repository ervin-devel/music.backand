<?php

use Illuminate\Support\Facades\Auth;

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
