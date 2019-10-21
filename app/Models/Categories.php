<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'name',
        'text'
    ];

    public function posts(){
        return $this->belongsToMany('App\Modeles\Posts','category_post');
    }
}
