<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\AssignUserPRoductRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HelperTrait;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use HelperTrait;

    public function __construct()
    {
        $this->middleware('permission:show-profile')->only(['show_profile']);
        $this->middleware('permission:show-user')->only(['show_user_profile']);
        $this->middleware('permission:change-password')->only(['change_password']);
        $this->middleware('permission:show-your-products')->only(['show_your_products']);
        $this->middleware('permission:show-user-products')->only(['show_user_product']);
        $this->middleware('permission:assign-product')->only(['assign']);
        $this->middleware('permission:add-user')->only(['add']);
        $this->middleware('permission:update-user')->only(['update']);
        $this->middleware('permission:delete-user')->only(['delete']);

    }
    //

    public function show_profile(){

        $user =auth('api')->user();
        return $this->customresponseformat('profile information',$user);

    }//end show_profile


    public function show_user_profile($id){

        $user =User::findOrfail($id);
        return $this->customresponseformat('user profile information',$user);
    }//end show_user_profile



    public function change_password(ChangePasswordRequest $request){

        $user = auth('api')->user();
        $check = Hash::check($request->old_password, $user->password);

         if($check){
             $user->password = $request->password ;
             $user->save();
             return $this->customresponseformat('changed password',$user);
         }else{

            return $this->customresponseformat('Password does not match',[]);
         }

    }//end change_password

    public function show_your_products(){
        $user = auth('api')->user();
        $product = $user->products()->paginate();
        return $this->customresponseformat('user products',$product);

    }//end user_your_products

    public function assign(AssignUserPRoductRequest $request){//assign product to user

        $user = User::find($request->id);
        $user->products()->attach($request->product_id);
        return $this->customresponseformat('Assign product to user successfully',$user);
    }//end assign


    public function add(AddUserRequest $request){

        $user =User::create($request->all());
        $role =Role::findById($request->role_id,'api');
        $user->assignRole($role);
        return  $this->customresponseformat('added user successfully',$user);

    }// end add

    public function update(Request $request,$id){

        $user = User::findOrfail($id);
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            'email'  =>[Rule::requiredIf(!$request->has('phone_number')),
                        'email',
                        'unique:users,email,'.$user->id],

            'phone_number' =>[Rule::requiredIf(!$request->has('email')),
                             'regex:/^[0]+[0-9]{9}$/',
                             'digits:10',
                             'unique:users,phone_number,'.$user->id],
            'role_id' =>'required|exists:roles,id'

        ]);

        if ($validator->fails()) {
            return $this->customresponseformat('validation error',$validator->errors());
        }

        $user->update($request->all());
        $role = $user->roles()->first();
        $user->removeRole($role);
        $new_role =Role::findById($request->role_id,'api');
        $user->assignRole($new_role);
        return $this->customresponseformat('update user successfully', $user);


    }//end update


    public function show_user_product($id){

        $user = User::findOrFail($id);
        $products = $user->products()->paginate();
        return $this->customresponseformat('user products',$products);
    }//end show_user_product

    public function delete($id){

        $user = User::findOrFail($id);
        $user->delete();
        return  $this->customresponseformat('deleted user successfully',[]);

    }//end delete


}//end class
