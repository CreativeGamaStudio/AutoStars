<?php

namespace App\DataTables;

use App\Models\ReturnNote;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReturnNoteDataTable extends DataTable
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
            ->addColumn('action', function ($returnnote) {
                $returnnoteasjson = json_encode($returnnote);
                $returnnoteasjson = str_replace("\"", "'", $returnnoteasjson);
                $returnnoteasjson = str_replace("\r\n", ' ', $returnnoteasjson);
                return '<div>
                    <a href="' . route('returnnotes.edit', $returnnote->id) . '" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i>
                        Edit
                    </a>
                    <a href="' . route('returnnotes.show', $returnnote->id) . '" class="btn btn-xs btn-info">
                        <i class="glyphicon glyphicon-edit"></i>
                        View
                    </a>
                    <a class="btn btn-danger delete" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modal-delete-returnnote"
                    data-bs-ids="' . $returnnote->id . '">Delete</a>
                </div>';
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ReturnNote $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ReturnNote $model): QueryBuilder
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
            ->setTableId('returnnote-table')
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
            Column::make('date'),
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
        return 'ReturnNote_' . date('YmdHis');
    }
}
