<?php

namespace App\DataTables;

use App\Models\State;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StateDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('state', function ($query) {
                return $query->state ?: '-';
            })
            ->editColumn('status', function ($query) {
                $statusButton = '<a href="' . route('stateStatus', ['id' => $query->id]) . '" class="status-toggle btn btn-sm ' . ($query->status == 1 ? 'btn-success' : 'btn-danger') . '" data-id="' . $query->id . '" data-status="' . $query->status . '">' . ($query->status == 1 ? 'Active' : 'Inactive') . '</a>';
                return $statusButton;
            })
            ->addColumn('action', function ($data) {

                $btn = '<a href="#" class="view btn btn-info btn-sm">View</a>';
                $btn = $btn . '<button type="button" data-id="' . $data->id . '"class="edit btn btn-primary btn-sm">Edit</button>';
                $btn = $btn . '<button type="button" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                return $btn;
            })
            ->rawColumns(['state','status','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(State $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('state-table')
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
            Column::make('state'),
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
        return 'State_' . date('YmdHis');
    }
}
