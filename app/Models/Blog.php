<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $table = 'blog';

    protected $fillable = [
        'meta_keywords', 'meta_description', 'title', 'slug', 'short_description', 'content', 'status', 'category_id' 
    ];
}
