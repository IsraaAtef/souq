<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'image_path',
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


  
public function getImageUrlAttribute()
{
    if (Str::startsWith($this->image_path, ['https://', 'http://'])) {
        return $this->image_path;
    }

    if (!$this->image_path) {
        return asset('assets/img/default-150x150.png');
    }

    return asset('storage/' . $this->image_path);
}}
