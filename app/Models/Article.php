<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ["title", "body", "premium", "user_id", "imagefile"];

    function comment() {
        return $this->hasMany(Comment::class);
    }

    function user() {
        return $this->belongsTo(User::class);
    }

    function category(){
        return $this->belongsToMany(Category::class);
    }
}
