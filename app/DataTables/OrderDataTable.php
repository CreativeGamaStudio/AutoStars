<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
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
                    <a href="' . route('orders.edit', $item->id) . '" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i>
                        Edit
                    </a>
                    <a href="' . route('orders.show', $item->id) . '" class="btn btn-xs btn-info">
                        <i class="glyphicon glyphicon-edit"></i>
                        View
                    </a>
                    <a href="' . route('orders.destroy', $item->id) . '" class="btn btn-xs btn-danger">
                        <i class="glyphicon glyphicon-edit"></i>
                        Delete
                    </a>
                </div>';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model): QueryBuilder
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
            ->setTableId('order-table')
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
            Column::make('date'),
            Column::make('order'),
            Column::make('complaint'),
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
        return 'Order_' . date('YmdHis');
    }
}