<?php

namespace App\Traits;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

trait FileTrait {

    // helper upload file
    public function upload( $file , $directory ) {
        $custom_file_name = time().'-'.$file->getClientOriginalName();
        $path = $file->storeAs($directory,$custom_file_name);
        return $path;
    }

    public function checkfile($request,$filed_name,$model){

        if ($request->hasFile($filed_name) && $request->$filed_name != '') {
            $filePath = storage_path().'/app/'.$model->$filed_name;
            if(File::exists($filePath)){
                unlink($filePath);
                return 1;
            }
            return 1;
        }
        return 0;
    }

    public function deletefile($path){
            $filePath = storage_path().'/app/'.$path;
            if(File::exists($filePath)){
                unlink($filePath);
                return 1;
            }
            return 1;
    }




}
