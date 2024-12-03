<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = [
        'namaGenre',
    ];

    public function books(){
        return $this->hasMany(Book::class, 'genre_id');
    }
}
