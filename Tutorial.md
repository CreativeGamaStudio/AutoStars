# Laravel

## Tutorial CRUD

## Bikin Data Table

```
php artisan datatables:make namaModel
```

```
Goto DataTable
Comment button
->buttons([
                        // Button::make('add'),
                        
                        // Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);

Buat kolom sesuai tabel di database ( cek migrations)
public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];
    }

```
Goto model
isi kolom
protected $fillable = [
        'name',
        'description',
        'price',
    ];
```

```
Goto controller
ganti index
public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('users.index');
    }
```

```
note cuma dibuat sekali
php artisan make:component modal

kemudian
modal.blade.php

pelajari penggunaan slot dan atrribute di laravel 9
https://laravel.com/docs/9.x/blade#rendering-components

````
```
Goto View
cek keterangan di index.blade.php
````


## Resource Controller (API) CRUD

1. Buat Tabel

```
php artisan make:migration create_Nama_table
```

2. Migrate

```
php artisan migrate
```

3. Buat Model

```
php artisan make:Model Nama
```

4. Buat Controller Berdasar Model

```
php artisan make:Controller NamaController --resource --model=Nama
```

5. Koneksikan ke [./routes/web.php](./routes)


