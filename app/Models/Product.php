<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug',
        'price',
        'store_id',
        'category_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'store_id' => 'integer',
        'category_id' => 'integer',
    ];
}
