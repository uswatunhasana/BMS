<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryTrashedDatatable extends DataTable
{
    public function dataTable($query)
    {
        $keyword = $this->request()->has('search.value');
        $word = null;
        if ($keyword) {
            $word = strtolower($this->request()->input('search.value'));
        }

        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->filterColumn('user_id', function ($query, $word) {
                $query->whereHas('user', function ($query) use ($word) {
                    $query->where('name', 'LIKE', "%{$word}%");
                });
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name;
            })
            ->editColumn('deleted_at', function ($data) {
                return $data->deleted_at->format('d-m-Y');
            })
            ->filterColumn('deleted_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(deleted_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('actions', function ($data) {
                $actions = "<button class='btn btn-success btn-sm btn-sm' onclick='restoreFunc(" . $data->id . ")' data-toggle='tooltip' data-placement='bottom' title='Restore Data'><i class='ti-reload'></i></button>";
                $actions .= "<button class='delete btn btn-danger btn-sm' onclick='deleteFunc(" . $data->id . ")' data-toggle='tooltip' data-placement='bottom' title='Delete Permanent'><i class='ti-trash'></i></button>";
                return $actions;
            })
            ->rawColumns(['actions']);

    }

    public function query(Category $model)
    {
        return $model->onlyTrashed()->applyScopes($model->query());
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('categorytrasheddatatable-table')
            ->addTableClass('table table-striped rounded display nowrap')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }

    protected function getColumns()
    {
        return [
            Column::computed('DT_RowIndex')
                ->title('No')
                ->width('3%'),
            Column::make('name')
                ->title('Category Name'),
            Column::make('user_id')
                ->title('Created by'),
            Column::make('deleted_at')
                ->title('Delete At'),
            Column::computed('actions')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'CategoryTrashed_' . date('YmdHis');
    }
}
