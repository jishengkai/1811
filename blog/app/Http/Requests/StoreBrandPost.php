<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandPost extends FormRequest
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
        return [
           'name' => 'required|unique:brand|max:255',
            'logo' => 'required',
            'url' => 'required',
            'desc' => 'required',
        ];
    
    }

    public function messages(){
         return [
            'name.required' => '品牌名称必填',
             'name.unique' => '品牌名称不能唯一',
             'name.max' => '品牌名称最长为255',
             'logo.required' => '品牌logo必填',
             'url.required' => '品牌地址必填',
             'desc.required' => '品牌介绍必填',
         ];
    }
}
