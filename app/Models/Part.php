<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $table = 'part';

    protected $fillable = [
        'barcode',
        'name',
        'qty',
        'selling_price',
        'purchase_price',
    ];
}
