<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{

    use HasFactory;

    protected $table = 'accesses';
    protected $guarded = [];

    public function getAccessToString(string|null $implode = ', ')
    {
        return $this->select('name')
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name')
            ->implode($implode);
    }

}
