<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request; 
use Illuminate\Support\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller; 
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index(){
        return view('backend.admin.settings');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required | email',
            'image' => 'required | image',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        $user = User::findOrFail(Auth::id());

        if(isset($image)){
            $currentDate = Carbon::now()-> toDateString();
            $imageName = $slug.'-'. $currentDate.'-'.uniqid(). '.' .$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile')) {
                Storage::disk('public')->makeDirectory('profile');
            }

            if (Storage::disk('public')->exists('profile/'.$user->image)) {
                Storage::disk('public')->delete('profile/'. $user->image);
            }
            $profile = Image::make($image)->resize(500, 500)->stream();
            Storage::disk('public')->put('profile/'.$imageName,$profile);

        } else{
            $imageName = $user->image;
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();

        if ($user) {
            Toastr::success('Profile Updated Sucessfully!', 'Success');
            return redirect()->back();
        } else {
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->back();
        }
    }

    public function updatePassword(Request $request){

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashPassword )){
            if (!Hash::check($request->password, $hashPassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::success('Password Updated Sucessfully!', 'Success');
                Auth::logout();
                return redirect()->back();  

            } 
            else {
                Toastr::error('New password can not be same as old one', 'Error');
                return redirect()->back();
            }

        } 
        else {
            Toastr::error('Old Password not matched', 'Error');
            return redirect()->back();
        }
    }
}
