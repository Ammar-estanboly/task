<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $data = $this->validationData();
        $id = array_key_exists('id',$data)?$data['id']:null;
        return [
            //
            'id'  =>'required|exists:products,id',
            'name' => 'required|unique:products,name,'.$id,
            'image' => [Rule::requiredIf(array_key_exists('image',$data)),
                        'image',
                        'mimes:jpg,png,jpeg,gif,svg',
                        'max:2048'],
            'description' => 'required',
        ];
    }
}
