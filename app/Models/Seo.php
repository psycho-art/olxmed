<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seo';
    
    protected $filable = [
        'name', 'title', 'keywords', 'description', 'image',
    ];
}
