<?php

namespace App\DataTables;

use App\Models\Service;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ServiceDataTable extends DataTable
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
            ->addColumn('action', function ($service) {
                $serviceasjson = json_encode($service);
                $serviceasjson = str_replace("\"", "'", $serviceasjson);
                $serviceasjson = str_replace("\r\n", ' ', $serviceasjson);
                return '<div>
                    <a href="' . route('services.edit', $service->id) . '" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i>
                        Edit
                    </a>
                    <a href="' . route('services.show', $service->id) . '" class="btn btn-xs btn-info">
                        <i class="glyphicon glyphicon-edit"></i>
                        View
                    </a>
                    <a class="btn btn-danger delete" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-delete-service"
                    data-bs-ids="' . $service->id . '">Delete</a>
                </div>';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Service $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Service $model): QueryBuilder
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
            ->setTableId('service-table')
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
                // Button::make('reload')

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
            Column::make('name'),
            Column::make('cost'),
            Column::make('action')->title('Actions')->orderable(false)->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Service_' . date('YmdHis');
    }
}
