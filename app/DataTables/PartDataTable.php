<?php

namespace App\DataTables;

use App\Models\Part;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PartDataTable extends DataTable
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
            ->addColumn('action', function ($part) {
                $partasjson = json_encode($part);
                $partasjson = str_replace("\"", "'", $partasjson);
                $partasjson = str_replace("\r\n", ' ', $partasjson);
                return '<div>
                    <a href="' . route('parts.edit', $part->id) . '" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i>
                        Edit
                    </a>
                    <a href="' . route('parts.show', $part->id) . '" class="btn btn-xs btn-info">
                        <i class="glyphicon glyphicon-edit"></i>
                        View
                    </a>
                    <a class="btn btn-danger delete" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-delete-part"
                    data-bs-ids="' . $part->id . '">Delete</a>
                </div>';
            })
            // ->addColumn('action', function ($part) {
            //     return '<a href="'.route('parts.destroy', $part->id).'" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-edit"></i> Delete</a>';
            // })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Part $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Part $model): QueryBuilder
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
            ->setTableId('part-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
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
            Column::make('name'),
            Column::make('qty'),
            Column::make('selling_price'),
            Column::make('purchase_price'),
            Column::make('action')->title('Actions')->orderable(false)->searchable(false),
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
        return 'Part_' . date('YmdHis');
    }
}
