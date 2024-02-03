<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;

class adminController extends Controller
{
    
    public function index(){
        return view('admin.dashboard');
    }

    public function login(Request $req){

        if($req->isMethod('post')){
            $data = $req->all();
            // dd($data);

                $validated = $req->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);
            
           if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
            return redirect('admin/dashboard');
           }
            else{
                return redirect()->back()->with('error','Incorrect Email or Password!');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function update_password(Request $req){

        if($req->isMethod('post')){
            $data = $req->all();

            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
               if($data['new_password']==$data['confirm_password']){
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success','congratulations! your password has been updated successfully.');
               }
               else{
                return redirect()->back()->with('error','Your new password and confirm password is not matching!.');
               }
            }
            else{
                return redirect()->back()->with('error','Your current password is incorrect!');
            }
        }
        return view('admin.update_password');
    }

   public function check_password(Request $req){
        $data = $req->all();
        if(Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)){
            return "true";
        } else {
            return "false";
        }
    }

    
}
