<?php
namespace App\Interfaces;

use Illuminate\Database\Eloquent\Relations\MorphMany;

interface Followable
{
    public function followers(): MorphMany;
}