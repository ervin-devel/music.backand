<?php

namespace App\Models;

use App\Traits\DataTables;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Access extends Model
{

    use HasFactory, DataTables;

    protected $table = 'accesses';
    protected $guarded = [];

    public function setSlugAttribute(string|null $slug): void
    {
        $this->attributes['slug'] = (empty($slug) ? Str::slug($this->name) : $slug);
    }

    public static function getDataTablesColumns(): array
    {
        return [
            'id' => 'ID', 'name' => 'Название', 'slug' => 'Слаг', 'actions' => 'Действия'
        ];
    }
    public function getRowsDatatable(array $filterParams): array
    {

        $this->setQueryBuild($filterParams, ['name', 'slug']);

        $accesses = $this->getQueryBuild()->get();

        $rows = [];
        foreach ($accesses AS $access) {
            $rows[] = [
                'id' => $access->id,
                'name' => $access->name,
                'slug' => $access->slug,
                'actions' => $access->getActionButtons([
                    'edit' => route('admin.access.edit', $access->id),
                    'delete' => route('admin.access.delete', $access->id)
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

    public function getAccessToString(string|null $implode = ', '): string
    {
        return $this->select('name')
            ->orderBy('name', 'asc')
            ->get()
            ->pluck('name')
            ->implode($implode);
    }

}
