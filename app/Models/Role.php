<?php

namespace App\Models;

use App\Traits\DataTables;
use App\Traits\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory, Helpers, DataTables;

    protected $table = 'roles';
    protected $guarded = [];

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'name' => 'Название', 'slug' => 'URL', 'actions' => 'Действия'
        ];
    }

    public function getRowsDatatable(array $filterParams): array
    {

        $this->setQueryBuild($filterParams, ['name', 'slug']);

        $roles = $this->getQueryBuild()->get();

        $rows = [];
        foreach ($roles AS $role) {
            $rows[] = [
                'id' => $role->id,
                'name' => $role->name,
                'slug' => $role->slug,
                'actions' => $role->getActionButtons([
                    'edit' => route('admin.role.edit', $role->id),
                    'delete' => route('admin.role.delete', $role->id)
                ])
            ];
        }

        return [
            'draw' => $filterParams['draw'],
            'iTotalRecords' => $this->getTotalRows(),
            'iTotalDisplayRecords' => $this->getTotalRowsWithFilter(),
            'aaData' => $rows
        ];
    }
    public function accesses(): BelongsToMany
    {
        return $this->belongsToMany(Access::class, 'access_roles', 'role_id', 'access_id');
    }
    public function syncAccess(array $accesses): void
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

        $this->accesses()->sync($accessIds);
    }
}
