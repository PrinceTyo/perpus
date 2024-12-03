<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index(){
        $genres = Genre::all();

        return view('author.genre.index', compact('genres'));
    }

    public function create(){
        return view('author.genre.create');
    }

    public function store(Request $request){
        $validasiGe = $request->validate([
            'namaGenre' => 'required|string|max:200',
        ]);

        Genre::create([
            'namaGenre' => $request->namagenre,
        ]);

        return redirect()->route('genre.index');
    }
}
