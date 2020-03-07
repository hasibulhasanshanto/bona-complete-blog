<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    public function index(){
        $authors = User::authors()
        ->withCount('posts')
        ->withCount('comments')
        ->withCount('favorite_posts')
        ->get();

        return view('backend.admin.authors', compact('authors'));
    }

    public function destroy($id){
        
        $author = User::findOrFail($id)->delete();

        if ($author) {
            Toastr::success('Author Deleted Sucessfully!!', 'Success');
            return redirect()->route('admin.author.index');
        } else {
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->back();
        } 
    }
}
