<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait DataTables
{

    protected $queryBuild;
    protected $totalRows;

    protected $totalRowsWithFilter;

    protected $searchValue;
    protected $searchColummns;

    public function buildQueryFilter()
    {
        $query = $this;

        foreach ($this->searchColummns AS $key => $column) {
            if ($key === 0) {
                $query = $query->where($column, 'LIKE', "%$this->searchValue%");
            } else {
                $query = $query->orWhere($column, 'LIKE', "%$this->searchValue%");
            }
        }
        return $query;
    }

    public function setQueryBuild(array $filterParams, array $searchByColumns = []): void
    {
        $this->searchColummns = $searchByColumns;
        $columnIndex = $filterParams['order'][0]['column'] ?? null;
        $columnName = $filterParams['columns'][$columnIndex]['data'] ?? [];
        $columnSortOrder = $filterParams['order'][0]['dir'] ?? null;

        $this->searchValue = $filterParams['search']['value'] ?? null;
        $this->searchValue = trim($this->searchValue);

        $this->totalRows = $this->count();

        if (mb_strlen($this->searchValue) > 1) {
            $this->totalRowsWithFilter = $this->buildQueryFilter()->count();
            $query = $this->buildQueryFilter();
        } else {
            $this->totalRowsWithFilter = $this->totalRows;
            $query = $this;
        }

        $query = $query->orderBy($columnName, $columnSortOrder)
            ->skip($filterParams['start'])
            ->take($filterParams['length']);

        $this->queryBuild = $query;
    }

    public function getTotalRows(): int
    {
        return $this->totalRows;
    }

    public function getTotalRowsWithFilter(): int
    {
        return $this->totalRowsWithFilter;
    }

    public function getQueryBuild()
    {
        return $this->queryBuild;
    }

    public function getActionButtons(array $actions)
    {
        return view('admin.templates.datatables.action', compact('actions'))->render();
    }

    public function getUserActivateBtn($user)
    {
        return view('admin.templates.datatables.user_activate_btn', compact('user'))->render();
    }

    public function getImage($img)
    {
        $img = Storage::url($img);
        return view('admin.templates.datatables.image', compact('img'))->render();
    }
}
