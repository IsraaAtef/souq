<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    //fillable
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'description',
        'image_path'

    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    protected $table = 'categories';

    //accessor
    public function getImageUrlAttribute(){ //$this->image_url
        if(Str::startsWith($this->image_path,['https','http'])){
            return $this->image_path;
        }

        if(!$this->image_path){
            return asset('assets/img/default-150*150.png');
        }
            return asset('storage/'.$this->image_path);
    }
}
