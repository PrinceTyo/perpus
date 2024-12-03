<?php

namespace App\Http\Controllers\Author;

use App\Http\Controllers\Controller;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class PenerbitController extends Controller
{
    public function index(){
        $penerbits = Penerbit::all();

        return view('author.penerbit.index', compact('penerbits'));
    }

    public function create(){
        return view('author.penerbit.create');
    }

    public function store(Request $request){
        $validasiPe = $request->validate([
            'namaPenerbit' => 'required|string|max:60',
        ]);

        Penerbit::create([
            'namaPenerbit' => $request->namaPenerbit,
        ]);

        return redirect()->route('penerbit.index');
    }

    public function edit(Penerbit $penerbit){
        return view('author.penerbit.edit', compact('penerbit'));
    }

    public function update(Request $request, Penerbit $penerbit){
        $validasiPe = $request->validate([
            'namaPenerbit' => 'required|string|max:60',
        ]);
        $penerbit->namaPenerbit = $request->namaPenerbit;

        $penerbit->save();

        return redirect()->route('penerbit.index');
    }

    public function destroy(Penerbit $penerbit){
        $penerbit->delete();

        return redirect()->route('penerbit.index');
    }
}
