<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title', 'keywords', 'description', 'content', 'locked', 'slug', 'place'
    ];
}
