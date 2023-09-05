<?php

namespace App\DataTables;

use App\Models\Hobby;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HobbiesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('Hobbies', function ($query) {
                return $query->hobbies ?: '-';
            })
            ->editColumn('status', function ($query) {
                return $query->status ?: '-';
            })
            ->addColumn('action', function ($query){
                $btn = '<a href="#" class="view btn btn-info btn-sm">View</a>';
                $btn = $btn.'<a href="#" class="add btn btn-primary btn-sm">Edit</a>';
                $btn = $btn.'<a href="#"  data-id="'.$query->id.'"  class="edit btn btn-danger btn-sm">Delete</a>';
    });

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Hobby $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('hobbies-table')
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
            Column::make('Hobbies'),
            Column::make('status'),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Hobbies_' . date('YmdHis');
    }
}
