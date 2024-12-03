<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Genre;
use App\Models\Penerbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();

        return view('author.book.index', compact('books'));
    }

    public function create(){
       $penerbits = Penerbit::all();
       $genres = Genre::all();

        return view('author.book.create', compact('penerbits', 'genres'));
    }

    public function store(Request $request){

        $validsasiBook = $request->validate([
            'judul' => 'required|string|max:50',
            'sinopsis' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'pengarang' =>'required|string|max:50',
            'penerbit_id' => 'required|exists:penerbits,id',
            'genre_id' => 'required|exists:genres,id',
        ]);

        $foto = $request->file('foto');
        $foto->storeAs('public', $foto->hashName());

        $book = Book::create([
            'judul' => $request->judul,
            'sinopsis' => $request->sinopsis,
            'foto' => $foto->hashName(),
            'pengarang' => $request->pengarang,
            'penerbit_id' => $request->penerbit_id,
            'genre_id' => $request->genre_id,
        ]);

        return redirect()->route('book.index');
    }

    public function edit(Book $book){
        $penerbits = Penerbit::all();
        $genres = Genre::all();

        return view('author.book.edit', compact('book','penerbits', 'genres'));
    }

    public function update(Request $request, Book $book){
        $validsasiBook = $request->validate([
            'judul' => 'required|string|max:50',
            'sinopsis' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'pengarang' =>'required|string|max:50',
            'penerbit_id' => 'required|exists:penerbits,id',
            'genre_id' => 'required|exists:genres,id',
        ]);

        if ($request->hasFile('foto')) {
            Storage::delete('public/' . $book->foto);
            $foto = $request->file('foto');
            $foto->storeAs('public', $foto->hashName());
            $book->foto = $foto->hashName();
        }

        $book->update([
            'judul' => $request->judul,
            'sinopsis' => $request->sinopsis,
            'pengarang' => $request->pengarang,
            'penerbit_id' => $request->penerbit_id,
            'genre_id' => $request->genre_id,
            'foto' => $book->foto,
        ]);

        return redirect()->route('book.index');
    }

    public function destroy(Book $book){
        if ($book->foto && Storage::exists('public/' . $book->foto)) {
            Storage::delete('public/' . $book->foto);
        }

        $book->delete();

        return redirect()->route('book.index');
    }

}
