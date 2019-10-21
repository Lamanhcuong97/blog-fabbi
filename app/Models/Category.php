<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table= "categories";
    protected $fillable = ['name', 'text'];

    /**
     * Relationship with Category Models
     *
     * @return array
     */
    public function posts(){
        return $this->belongsToMany('App\Models\Post', 'category_post', 'category_id', 'post_id');
    }
}
