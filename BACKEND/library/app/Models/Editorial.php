<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'editorial';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'address'
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
