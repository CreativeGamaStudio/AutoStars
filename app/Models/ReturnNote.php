<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnNote extends Model
{
    use HasFactory;

    protected $table = 'return_note';

    protected $fillable = [
        'id',
        'date',
    ];
}
