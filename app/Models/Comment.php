<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["body", "article_id", "user_id"];

    function article(){
        return $this->belongsTo(Article::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
