<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';
    protected $fillable = [
        'name',
        'slug',  // Assuming 'slug' is also mass-assigned
        // Add any other fields you want to allow mass assignment for
    ];
}
