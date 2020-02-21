<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $posts = Auth::user()->posts;
        return view('backend.author.comments', compact('posts'));
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment->post->user->id == Auth::id()) {
            $comment->delete();
            Toastr::success('Comment Deleted Sucessfully!', 'Success');
            return redirect()->back();
        } else{
            Toastr::error('You are not Authorized to delete this comment :(', 'Accees Denined !!!');
            return redirect()->back();
        }
        
    }
}
