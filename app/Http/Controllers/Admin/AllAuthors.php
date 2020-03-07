<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AllAuthors extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = User::whereIn('role_id', [1, 2] )->get();
        return view('backend.admin.author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //Data Validation 
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6 ',
            'role_id' => 'required',
        ]);

    //Save all to User
        $user = new User();
        $user->name = Str::title($request->name);
        $user->username = Str::slug($request->username);
        $user->email = Str::lower($request->email);
        $user->password = Hash::make($request->password);
        $user->role_id = intval($request->role_id); 
        //return $user;
        $user->save();

        if ($user) {
            Toastr::success('Author Created Sucessfully!!', 'Success');
            return redirect()->route('admin.allauthors.create');
        } else {
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.allauthors.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = User::where('id', $id)->first(); 
        return view('backend.admin.author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Data Validation 
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required', 
            'role_id' => 'required',
        ]);

        //Update User
        $user = User::findOrFail($id);
        $user->name = Str::title($request->name);
        $user->username = Str::slug($request->username);
        $user->email = Str::lower($request->email); 
        $user->role_id = intval($request->role_id); 
        $user->update();

        if ($user) {
            Toastr::success('Author Updated Sucessfully!!', 'Success');
            return redirect()->route('admin.allauthors.index');
        } else {
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.allauthors.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = User::findOrFail($id);

        if (Storage::disk('public')->exists('profile/' . $author->image)) {

            Storage::disk('public')->delete('profile/' . $author->image);
        }

        $author->delete();

        if ($author) {
            Toastr::success('Author Deleted Sucessfully!', 'Success');
            return redirect()->route('admin.allauthors.index');
        } else {
            Toastr::error('Something Went Wrong :/' , 'Error');
            return redirect()->route('admin.allauthors.index');
        }
    }
}
