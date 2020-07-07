<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id', 'thumbnail'];

    //protected $guarded = [];
    public function scopeLatestFirst()
    {
        return $this->latest()->first();
    }

    public function category()
    {
        //return $this->hasOne(Category::class);
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // cara 1 dengan menjadikan atribut
    public function getTakeImageAttribute()
    {
        return '/storage/' . $this->thumbnail;
    }

    // cara 2 dengan menjadikan method
    public function getImage()
    {
        return '/storage/' . $this->thumbnail;
    }
}
