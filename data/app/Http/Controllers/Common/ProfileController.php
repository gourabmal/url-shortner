<?php

namespace App\Http\Controllers\Common;

use App\Helper\admin\ImageUpload;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /*** Profile ***/
    public function profile($name)
    {
        $user = User::where('id',$name)->first();
        $session['password'] = Session::get('password');
        Session::put('password',false);
        return view('common.profile.index',compact('user','session'));
    }
    /*** Profile Update ***/
public function profile_update(Request $request)
{
    Session::put('password', false);

    $msg = [
        'first_name.required' => 'Please Enter Your First Name.',
        'last_name.required' => 'Please Enter Your Family Name.',
        'email.required' => 'Please Enter Your Email.',
        'phone.required' => 'Please Enter Your Phone Number.',
        'email.email' => 'Please Enter A Valid Email.',
        'email.unique' => 'Email Must Be Unique.',
        'phone.numeric' => 'Please Enter A Valid Phone Number.',
        'phone.unique' => 'Phone Number Must Be Unique.',
    ];

    $this->validate($request, [
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email,' . Auth::id(),
        'phone' => 'required|numeric|unique:users,phone,' . Auth::id(),
    ], $msg);

    try {
        $path = '/uploads/profile/'; // no leading slash
        $userUpdate = User::findOrFail(Auth::id());
        $existingImage = $userUpdate->profile_picture;

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = ImageUpload::updateImage($existingImage, $path, $request->file('image'));
        }

        // Only update image if new one uploaded
        if (!empty($imageName)) {
            $userUpdate->profile_picture = $imageName;
        }

        $userUpdate->first_name = $request->first_name;
        $userUpdate->last_name = $request->last_name;
        $userUpdate->email = $request->email;
        $userUpdate->phone = $request->phone;
        $userUpdate->save();

        return redirect()->route('common.profile', ['name' => $userUpdate->id])->with('success', 'Profile Updated Successfully!');
    } catch (\Exception $exception) {
        return redirect()->back()->with('error', $exception->getMessage());
    }
}


    /*** Password Update ***/
    public function password_update(Request $request)
    {
        Session::put('password',true);
        $msg = [
            'old_password.required' => 'Please Enter Old Password.',
            'new_password.required' => 'Plesae Enter New Password.',
            'confirm_password.required' => 'Plesae Enter Confirm Password.',
        ];
        $this->validate($request, [
            'old_password' => 'required|min:6',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|min:6|required_with:new_password|same:new_password',
        ], $msg);
        try {
            $old_pass=$request->old_password;
            $new_pass=$request->new_password;
            $confirm_pass=$request->confirm_password;
            $id=Auth::user()->id;
            $pass= User::where('id',$id)->value('password');
            if(Hash::check($old_pass,$pass))
            {
                if($new_pass==$confirm_pass){
                    $password=Hash::make($new_pass);
                    $changePass=User::where('id',$id)->update([
                        'password' => $password,
                    ]);
                    if($changePass==true){
                        return redirect()->route('common.profile',['name'=>$id])->with('password_success', 'Password Updated Successfull!');
                    }
                }else{
                    return redirect()->route('common.profile',['name'=>$id])->with('password_error', 'New Password and Confirm Password are Not Matched !!!');
                }
            }
            else{
                return redirect()->route('common.profile',['name'=>$id])->with('password_error', 'Old Password Not Matched !!!');
            }
        }catch (Exception $exception){
            return redirect()->back()->with('error','Something Wrong!');
        }
    }
    /*** Admin Logout ***/
    public function admin_logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('admin_login')->with('success','You have been successfully logged out!');
    }
}
