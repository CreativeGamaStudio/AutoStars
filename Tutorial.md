# Laravel

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

4. Buat Conroller Berdasar Model

```
php artisan make:Controller NamaController --resource --model=Nama
```

5. Koneksikan ke [./routes/web.php](./routes)