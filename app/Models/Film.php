<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Film extends Model
{
    use HasFactory, SoftDeletes;

    // Assignement
    protected $fillable = ['title', 'year', 'description'];

    // Permet de trouver la catégorie à laquelle appartient (belongsTo) le film
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
