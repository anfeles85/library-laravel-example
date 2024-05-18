<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'member';
    protected $fillable = [
        'document',
        'firstname',
        'lastname',
        'email',
        'phone'
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
