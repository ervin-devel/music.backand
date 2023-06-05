<?php
namespace App\Traits;

trait Helpers
{
    public function isJson($string)
    {
        return is_object(json_decode($string));
    }

}
