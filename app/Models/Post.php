<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'description', 'content', 'thumnail', 'user_id'];
    
     /**
      * Relationship with Post Model
      *
      * @return array
      */
    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'category_post', 'post_id', 'category_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
