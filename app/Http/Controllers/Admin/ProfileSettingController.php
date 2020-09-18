<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProfileSettingController extends Controller
{
   public function changeProfile()
   {
       $user = auth()->user();
       return view('admin.change_profile',[
          'user' =>$user
       ]);
   }
    public function update_profile(Request $request){
        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|email',
            'curr_password'=>'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);


        $data = $request->all();
        $user = auth()->user();
        if(!Hash::check($data['curr_password'], $user->password)){
            return back()->with('error','The specified password does not match the database password');
        }else{
            $request->user()->fill(['name'=>$request->name,'email'=>$request->email,'password' => Hash::make($request->password)])->save();
        }

        return redirect()->back()->with('success','profile updated');
    }

}
