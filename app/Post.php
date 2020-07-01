<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //protected $fillable = ['title', 'slug', 'body'];

    protected $guarded = [];
    public function scopeLatestFirst()
    {
        return $this->latest()->first();
    }
}
