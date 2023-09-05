<?php

namespace App\DataTables;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Psy\Readline\Hoa\Console;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CountryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('countryname', function ($query) {
                return $query->countryname ?: '-';
            })
            ->editColumn('status', function ($query) {
                $statusButton = '<a href="' . route('countryStatus', ['id' => $query->id]) . '" class="status-toggle btn btn-sm ' . ($query->status == 1 ? 'btn-success' : 'btn-danger') . '" data-id="' . $query->id . '" data-status="' . $query->status . '">' . ($query->status == 1 ? 'Active' : 'Inactive') . '</a>';
                return $statusButton;
            })

            ->addColumn('action', function ($data) {
                $btn = '<a href="#" class="view btn btn-info btn-sm">View</a>';
                $btn = $btn . '<button type="button" data-id="' . $data->id . '"class="edit btn btn-primary btn-sm">Edit</button>';
                $btn = $btn . '<button type="button" data-id="' . $data->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                return $btn;
            })

            ->rawColumns(['countryname','status','action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Country $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('country-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters($this->getBuilderParameters());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('countryname'),
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
        return 'Country_' . date('YmdHis');
    }
}
