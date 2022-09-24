<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = [
            'message'=>'user logout',
            'alert-type'=>'info'
        ];
        return redirect('login')->with($notification);
    }

    public function profile(){
        $adminData = User::find(Auth::id());
        return view('admin.admin_profile_view',compact('adminData'));
    }

    public function editProfile(){
        $editData = User::find(Auth::id());
        return view('admin.admin_profile_edit',compact('editData'));
    }

    public function storeProfile(Request $request){
        $data = User::find(Auth::id());
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if($request->profile_image){
            @unlink(public_path('upload/admin_images/'.$data->profile_image));
            $file = $request->profile_image;
            $filename = date('YmdHi').$file->getClientOriginalName();

            $file->move(public_path('upload/admin_images'),$filename);
            $data->profile_image = $filename;
        }   
        $data->save();
        $notification = [
            'message'=>'user data updated',
            'alert-type'=>'success'
        ];
        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword(){
        return view('admin.admin_change_password');
    }

    
    public function UpdatePassword(Request $request){
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]);

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword,$hashedPassword )) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();

            session()->flash('message','Password Updated Successfully');
            return redirect()->back();
        } else{
            session()->flash('message','Old password is not match');
            return redirect()->back();
        }
    }
}
