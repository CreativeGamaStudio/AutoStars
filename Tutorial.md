# Laravel

## Tutorial CRUD
reference : https://www.tutsmake.com/laravel-9-crud-application-tutorial-with-example/

```
## ADD
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

```
### Edit

1. goto views

tambahin modal edit dan script js edit

ref : [./views/items/index.blade.php](./views)

2. Update Controller edit

tambahin di function update
$request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);
        $item = Item::find($id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->save();
        
        return redirect()->route('items.index')->with('success', 'item has been updated successfully.');

3. goto datatable
->addColumn('action', function ($item) {
                $itemasjson = json_encode($item);
                $itemasjson = str_replace("\"", "'", $itemasjson);
                $itemasjson = str_replace("\r\n", ' ', $itemasjson);
                return '<a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#modal-edit-item" data-bs-item="' . $itemasjson . '"><i class="fas fa-eye"></i> Edit</a>';
            })

```



## Tutorial Action Button
Tombol edit
```

```
goto datatable
goto function dataTable

public function dataTable(QueryBuilder $query) :EloquentDataTable

add column

            })->addColumn('action',  function ($user) {
                return '<a href="'.route('users.edit', $user->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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


##databaseseeder

-. Buka terminal

php artisan make:factory NamaFactory --model=Item


-. Goto database/seeders/DatabaseSeeder.php

 \App\Models\Employee::factory(10)->create();

-. goto  database/factories/InvoiceFactory.php
public function definition()
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(1000, 100000),
        ];
    }

-. type php artisan db:seed di terminal

-. php artisan migrate:fresh --seed ( untuk reset ulang)


##Delete

1.  app/DataTables/InvoiceDataTable.php

->addColumn('action', function ($item) {
                $itemasjson = json_encode($item);
                $itemasjson = str_replace("\"", "'", $itemasjson);
                $itemasjson = str_replace("\r\n", ' ', $itemasjson);
                return '<div>
                    <a
                        data-bs-toggle="modal"
                        data-bs-target="#modal-edit-item"
                        data-bs-item="'. $itemasjson .'" class="btn btn-xs btn-primary">
                        <i class="glyphicon glyphicon-edit"></i>
                        Edit
                    </a>
                    <a class="btn btn-danger delete"
                    data-bs-toggle="modal"
                    data-bs-target="#modal-delete-invoice" //yg diganti cuma modal-delete-.....
                    data-bs-ids="'.$item->id.'">Delete</a>
                </div>';
            })

NB : item gausah diganti

2. goto app/Http/Controllers/InvoiceController.php

 public function destroy(Request $request, $id)
    {
        //
        $item = Invoice::find($request->id); //invoice ginti
        if ($item)
        {
            $item->delete();
        }

        return redirect()->route('invoices.index')->with('success', 'Invoices has been deleted successfully.'); //invoice ginti
    }


3. goto view

resources/views/invoices/index.blade.php

<x-modal id="modal-delete-invoice" size="sm"> //invoice diganti
        <x-slot:title>Delete</x-slot:title>
        <div class="modal-body text-center py-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 9v2m0 4v.01"></path>
                <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75">
                </path>
            </svg>
            <h3>Are you sure?</h3>
            <div class="text-muted">Apakah anda yakin ingin menghapus data ini?</div>
        </div>
        <form action="{{ route('invoices.destroy', 'id') }}" method="post"> //invoice diganti
            @csrf
            @method('DELETE')
            <input id="id" name="id" hidden>

            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" type="button" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button class="btn btn-danger w-100" type="submit">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </x-modal>

    {{-- script delete --}}
    <script> 
        var exampleModal = document.getElementById('modal-delete-invoice')
        var modalBodyInput = document.getElementById('id')
        exampleModal.addEventListener('show.bs.modal', function(event) { 
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-ids') 
            console.log(recipient)
            modalBodyInput.value = recipient
        })
    </script>
