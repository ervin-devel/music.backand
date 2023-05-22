<?php

namespace App\Models;

use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, Helpers;

    protected $table = 'roles';
    protected $guarded = [];

    public function accesses()
    {
        return $this->belongsToMany(Access::class, 'access_roles', 'role_id', 'access_id');
    }

    public function syncAccess(array $accesses)
    {
        $accessIds = [];

        foreach ($accesses AS $accessItem) {
            if ($this->isJson($accessItem)) {
                $accessItem = json_decode($accessItem, true);
                $accessIds[] = $accessItem['id'];
            }
            else {
                $createdAssests = Access::create([
                    'name' => $accessItem,
                    'slug' => \Illuminate\Support\Str::slug($accessItem)
                ]);
                $accessIds[] = $createdAssests->id;
            }
        }

        //$this->access()->delete();
        $this->accesses()->sync($accessIds);
    }
}
