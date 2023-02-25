<?php

namespace App\DataTables;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RegistrationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($item) {
            $itemasjson = json_encode($item);
            $itemasjson = str_replace("\"", "'", $itemasjson);
            $itemasjson = str_replace("\r\n", ' ', $itemasjson);
            return '<div>
            <a
            data-bs-toggle="modal"
            data-bs-target="#modal-edit-registration"
            data-bs-item="'. $itemasjson .'" class="btn btn-xs btn-primary">
            <i class="glyphicon glyphicon-edit"></i>
            Edit </a>
            
            <a class="btn btn-danger delete" 
                data-bs-toggle="modal"  
                data-bs-target="#modal-delete-registration"
                data-bs-ids="'.$item->id.'">Delete</a>
            </div>';
        })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Registration $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Registration $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('registration-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
                //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                // Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('barcode'),
            Column::make('police_number'),
            Column::make('date'),
            Column::make('odometer'),
            Column::make('pkb_flag'),
            Column::make('status'),
            Column::make('action')->title('Actions')->orderable(false)->searchable(false),
            // Column::make('created_at'),
            // Column::make('updated_at'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Registration_' . date('YmdHis');
    }
}