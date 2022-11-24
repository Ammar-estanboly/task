<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\AddUserRequest;
use App\Http\Requests\User\AssignUserPRoductRequest;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    //    public function __construct()
    public function __construct()
    {
        $this->middleware('permission:show-profile')->only(['show_profile']);
        $this->middleware('permission:show-user')->only(['show_users','show_user_profile']);
        $this->middleware('permission:change-password')->only(['change_password','show_change_password']);
        $this->middleware('permission:show-your-products')->only(['show_your_products']);
        $this->middleware('permission:show-user-products')->only(['show_user_product']);
        $this->middleware('permission:assign-product')->only(['assign','show_assign']);
        $this->middleware('permission:add-user')->only(['add','store']);
        $this->middleware('permission:update-user')->only(['update','edit']);
        $this->middleware('permission:delete-user')->only(['delete']);

    }

    public function show_users(){
        $users = User::where('id','<>',auth()->user()->id)->paginate();
        return view('dashboard.user.show_users',compact('users'));

    }//end show_users

    public function add(){
        $roles = Role::where('guard_name','web')->get();

        return view('dashboard.user.add_user',compact('roles'));

    }//end show_users

    public function store(AddUserRequest $request){
        $user =User::create($request->all());
        $role =Role::findById($request->role_id,'web');
        $user->assignRole($role);
        toastr()->success("add user succses");
        return  redirect()->route('show-users');

    }//end store

    public function update($id){

        $user =User::with(['roles' => function($q){
            $q->where('guard_name','web');
        }])
        ->where('id',$id)
        ->first();

        $data['roles'] = Role::where('guard_name','web')->get();
        $data['user'] = $user;
        //return $data;
        return view('dashboard.user.edit_user',$data);

    }//end update

    public function show_user_profile($id){

        $user =User::findOrfail($id);
        return view('dashboard.user.show_user',compact('user'));
    }//end show_user_profile

    public function show_assign($id){
        $user = User::findOrfail($id);
        $products = DB::select('SELECT * FROM products
                                WHERE id not in (SELECT DISTINCT p.product_id
                                FROM prouducts_users p INNER JOIN users u on p.user_id = ?)',[$id]);

        $data['user'] = $user;
        $data['products'] = $products;
        //SELECT DISTINCT p.product_id FROM prouducts_users p INNER JOIN users u on p.user_id = 2
        return view('dashboard.user.assign_product',$data);
    }//show_assign

    public function assign(AssignUserPRoductRequest $request){//assign product to user

        $user = User::find($request->id);
        $user->products()->attach($request->product_id);
        toastr()->success("assign product to user succses");
        return  redirect()->route('show-assing-product',[$user->id]);
    }//end assign


    public function edit(Request $request, $id){

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
            return back()->withErrors($validator);
        }

        $user->update($request->all());
        $role = $user->roles()->first();
        $user->removeRole($role);
        $new_role =Role::findById($request->role_id,'web');
        $user->assignRole($new_role);
        toastr()->success("edit user succses");
        return  redirect()->route('show-users');


    }//end edit

    public function show_profile(){

        $user =auth()->user();
        return view('dashboard.user.profile',compact('user'));

    }//end show_profile

    public function show_change_password(){
        return view('dashboard.user.changepassword');

    }//end show_change_password

    public function change_password(ChangePasswordRequest $request){
        $user = auth()->user();
        $check = Hash::check($request->old_password, $user->password);

         if($check){
             $user->password = $request->password ;
             $user->save();
             toastr()->success("change password succses");
             return redirect()->route('dashboard');
         }else{
            toastr()->error("password not match");
            return redirect()->route('show-change-password');
         }

    }//end change_password

    public function show_your_products(){
        $user = auth()->user();
        $products = $user->products()->paginate();
        return view('dashboard.user.show_user_products',compact('products'));

    }//end user_your_products

    public function show_user_product($id){

        $user = User::findOrFail($id);
        $products = $user->products()->paginate();
        return view('dashboard.user.show_user_products',compact('products'));
    }//end show_user_product


    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $user = User::findOrFail($request->user_id);
        $user->delete();
        toastr()->success("delete user succses");
        return  redirect()->route('show-users');

    }//end delete


}//end class
