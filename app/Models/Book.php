<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'author_id',       // keep if you want author relation
        'publish_date',
        'description',
        'ISBN',
        'image',
        'publication_year',
        'available_copies',
    ];
    
    

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'book_category');
    }
}