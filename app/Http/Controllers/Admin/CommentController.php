<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CommentController extends Controller
{
    public function index(){
        $comments = Comment::latest()->get();
        return view('backend.admin.comments', compact('comments'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id)->delete();
        Toastr::success('Comment Deleted Sucessfully!', 'Success');
        return redirect()->back();
    }
}

