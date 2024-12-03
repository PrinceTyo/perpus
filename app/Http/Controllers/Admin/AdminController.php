<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $pendingAuthors = User::where('usertype', 'author')
                              ->where('is_approved', false)
                              ->get();

        return view('admin.dashboard', compact('pendingAuthors'));
    }

    public function approveAuthors($id){
        $author = User::find($id);

        if($author && $author->usertype === 'author'){
            $author->is_approved = true;
            $author->save();

            return redirect()->back()->with('success', 'Penulis berhasil disetujui');
        }

        return redirect()->back()->with('error', 'Penulis tidak ditemukan');

    }
}
