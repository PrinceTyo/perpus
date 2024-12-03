<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'judul',
        'foto',
        'pengarang',
        'sinopsis',
        'penerbit_id',
        'genre_id',
    ];

    //Relasi Many to One
    public function penerbit(){
        return $this->belongsTo(Penerbit::class, 'penerbit_id');
    }

    public function genre(){
        return $this->belongsTo(Genre::class, 'genre_id');
    }
}
