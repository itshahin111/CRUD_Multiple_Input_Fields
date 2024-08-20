<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'items';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'image',
        'quantity',
    ];

    // Define any relationships if necessary
    // e.g., if Item belongs to another model:
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}