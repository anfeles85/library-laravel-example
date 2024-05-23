<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'book';
    protected $fillable = [
        'isbn',
        'title',
        'author',
        'editorial_id',
        'category_id'
    ];

    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
