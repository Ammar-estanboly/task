<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HelperTrait;
use Exception;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    use HelperTrait;
    //register

    public function register(RegisterRequest $request){
         try{
                DB::beginTransaction();
                $user =User::create($request->all());
                $token = $user->createToken('LaravelAuthApp')->accessToken;
                DB::commit();
                return $this->customresponseformat('You are logged in successfully',$token);

            } catch(Exception $e){
                return $this->customresponseformat('Login failed system error',[],404);
            }//end catch
    }//end function register

    public function login(LoginRequest $request){

        $credential = $this->credentials($request->username);
        $data = [
            $credential => $request->username,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {

            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return $this->customresponseformat('You are logged in successfully',$token);

        } else {

            return $this->customresponseformat('Unauthorised',[],401);

        }
    }//end login


    protected function credentials($credential)
    {
        if (is_numeric($credential)) {
            return 'phone_number'; //'phone_number';
        } elseif (filter_var($credential, FILTER_VALIDATE_EMAIL)) {
            return 'email'; //'email';
        }
        return 'no data'; //error
    } //end of function credentials


}
