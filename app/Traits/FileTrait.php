<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

trait FileTrait {

    // helper upload file
    public function upload( $file , $directory ) {
        $custom_file_name = time().'-'.$file->getClientOriginalName();
        $file->move(public_path($directory), $custom_file_name);
        //$path = $file->storeAs($directory,$custom_file_name);
        return $directory.'/'.$custom_file_name;
    }

    public function checkfile($request,$filed_name,$model){

        if ($request->hasFile($filed_name) && $request->$filed_name != '') {
            $filePath = public_path().'/'.$model->$filed_name;

            if(File::exists($filePath)){
                unlink($filePath);
                return 1;
            }
            return 1;
        }
        return 0;
    }

    public function deletefile($name){
            $filePath = public_path().'/'.$name;
            if(File::exists($filePath)){
                unlink($filePath);
                return 1;
            }
            return 1;
    }




}
