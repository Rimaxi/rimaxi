<?php

namespace App\DataTables;

use App\Models\Write;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class WriteDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('write', function ($query) {
                return $query->write ?: '-';
            })
            ->editColumn('email', function ($query) {
                return $query->email ?: '-';
            })
            ->editColumn('status', function ($query) {
                $statusButton = '<a href="# " class="status-toggle btn btn-sm ' . ($query->status == 1 ? 'btn-success' : 'btn-danger') . '" data-id="' . $query->id . '" data-status="' . $query->status . '">' . ($query->status == 1 ? 'Active' : 'Inactive') . '</a>';
                return $statusButton;
            })

            ->addColumn('action', function ($write) {

                $btn = '<a href="#" class="view btn btn-info btn-sm">View</a>';
                $btn = $btn . '<a href="' . route('write.edit', ['write' => $write->id]) . '"  type="button" data-id="' . $write->id . '"class="edit btn btn-primary btn-sm">Edit</a>';
                $btn = $btn . '<a href="' . route('write.destroy', ['write' => $write->id]) . '"  type="button" data-id="' . $write->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })
            ->rawColumns(['write', 'email', 'status', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Write $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('write-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('write'),
            Column::make('email'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Write_' . date('YmdHis');
    }
}
