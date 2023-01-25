<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserTrashedDatatable extends DataTable
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
            ->editColumn('user.role', function ($data) {
                if ($data->role == 0) {
                    return "<div class='badge badge-info'>Superadmin</div>";
                } else if ($data->role == 1) {
                    return '<div class="badge badge-success">Admin</div>';
                } else {
                    return "<div class='badge badge-warning'>Writer</div>";
                }
            })
            ->filterColumn('user.role', function ($query, $word) {
                $query->whereHas('role', function ($query) use ($word) {
                    $query->where('value', 'LIKE', "%{$word}%");
                });
            })
            ->editColumn('deleted_at', function ($data) {
                return $data->deleted_at->format('d-m-Y');
            })
            ->filterColumn('deleted_at', function ($query, $keyword) {
                $query->whereRaw("DATE_FORMAT(deleted_at,'%d/%m/%Y') like ?", ["%$keyword%"]);
            })
            ->editColumn('actions', function ($data) {
                // $actions = " <a href=" . route('restore.user', $data->id) . " class='btn btn-success btn-sm'data-toggle='tooltip' data-placement='bottom' title='Restore Data'><i class='ti-reload'></i></a>";
                $actions = "<button class='btn btn-success btn-sm btn-sm' onclick='restoreFunc(" . $data->id . ")' data-toggle='tooltip' data-placement='bottom' title='Restore Data'><i class='ti-reload'></i></button>";
                $actions .= "<button class='delete btn btn-danger btn-sm' onclick='deleteFunc(" . $data->id . ")' data-toggle='tooltip' data-placement='bottom' title='Delete Permanent'><i class='ti-trash'></i></button>";
                return $actions;
            })
            ->rawColumns(['actions', 'user.role']);
    }

    public function query(User $model)
    {
        return $model->onlyTrashed()->applyScopes($model->query());
    }

    public function html()
    {
        return $this->builder()
            ->setTableId('usertrasheddatatable-table')
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
            Column::make('name'),
            Column::computed('user.role')
                ->title('Role')
                ->width('15%')
                ->addClass('text-center'),
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
        return 'UserTrashed_' . date('YmdHis');
    }
}
