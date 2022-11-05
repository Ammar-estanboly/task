<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use Illuminate\Http\Request;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HelperTrait;
    //

    public function show_profile(){
        $user =auth()->user();
        return $this->customresponseformat('user profile information',$user);
    }//end show_profile

    public function change_password(ChangePasswordRequest $request){
        $user = auth()->user();
        $check = Hash::check($request->old_password, $user->password);

         if($check){
             $user->password = $request->password ;
             $user->save();
             return $this->customresponseformat('changed password',$user);
         }else{

            return $this->customresponseformat('Password does not match',[]);
         }

    }//end change_password

}
