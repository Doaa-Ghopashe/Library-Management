<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'description',
        'author_id',
        'num_books',
        'category_id'
    ];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function categories()
    {
    return $this->belongsToMany(Category::class, 'book_category', 'book_id', 'category_id');
    }
    

}

