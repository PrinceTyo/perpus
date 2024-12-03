<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    protected $fillable = [
        'namaPenerbit',
    ];

    //Relasi One to Many
    public function books(){
        return $this->hasMany(Book::class, 'penerbit_id');
    }
}
