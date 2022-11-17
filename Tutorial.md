# Laravel

## Tutorial CRUD
reference : https://www.tutsmake.com/laravel-9-crud-application-tutorial-with-example/

```
1. create
goto controller

goto funtion store
public function store(Request $request)

this is the code
$request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required',
            'status' => 'required',
        ]);

        // create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // redirect to users.index
        return redirect()->route('users.index')->with('success', 'User created successfully.');

```


## Tutorial Action Button
Tombol edit
```

```
goto datatable
goto function dataTable

public function dataTable(QueryBuilder $query) :EloquentDataTable

add column
->addColumn('action',  function ($user) {
                return '<a href="'.route('users.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
```



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


