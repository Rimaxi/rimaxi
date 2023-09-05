<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;


class UserDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('age', function ($data) {
                return Carbon::parse($data->dob)->age;
            })
            ->addColumn('action', function ($user) {

                $btn = '<a href="#" class="view btn btn-info btn-sm">View</a>';
                $btn = $btn . '<a href="' . route('edit', ['id' => $user->id]) . '"  type="button" data-id="' . $user->id . '"class="edit btn btn-primary btn-sm">Edit</a>';
                $btn = $btn . '<button type="button" data-id="' . $user->id . '" class="delete btn btn-danger btn-sm">Delete</button>';
                return $btn;
            })
            ->editColumn('phone', function ($query) {
                return $query->phone ?: '-';
            })
            ->editColumn('country_id', function ($query) {
                return ($query?->country?->countryname ?: '-');
            })
            ->editColumn('state_id', function ($query) {
                return ($query?->state?->state ?: '-');
            })
            ->editColumn('city_id', function ($query) {
                return ($query?->city?->city ?: '-');
            })
            ->editColumn('hobbies', function ($query) {
                return ($query?->hobbies ?: '-');
            })
            ->filterColumn('NO', function ($data, $keyword) {
                $sql = "CONCAT(users.No,'-',users.name)  like ?";
                $data->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->rawColumns(['age', 'action', 'No', 'phone', 'country_id', 'state_id', 'city_id', 'hobbies'])
            ->addIndexColumn();
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->with('country', 'state', 'city')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('user-table')
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

            Column::make('no')->data('DT_RowIndex'),
            Column::make('id')->hidden(),
            Column::make('name'),
            Column::make('email'),
            Column::make('age')->title('Age')->defaultContent(''),
            Column::make('phone'),
            Column::make('hobbies'),
            Column::make('country_id')->name('country.countryname'),
            Column::make('state_id')->name('state.state'),
            Column::make('city_id')->name('city.city'),
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
        return 'User_' . date('YmdHis');
    }
}
