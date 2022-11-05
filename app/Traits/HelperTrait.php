<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait HelperTrait {

    public function customresponseformat($message,$data,$code=200){

        return response()->json(['message' => $message, 'data'=>$data],$code);
    }

}
