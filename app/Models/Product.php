<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'price',
        'condition',
        'slug',
        'city_id',
        'state',
        'user_id',
        'posted_by',
        'status',
        'featured',
        'neighbourhood',
        'number'
    ];

    use HasFactory;
}
