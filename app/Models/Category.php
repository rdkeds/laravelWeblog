<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ["name"];

    function article(){
        return $this->belongsToMany(Article::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
