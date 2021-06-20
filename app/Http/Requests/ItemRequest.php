<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Request;

class ItemRequest extends FormRequest
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
            //
            "product_name" => "required|string",
            "arrival_source" => "nullable|string",
            "manufacturer" => "nullable|string",
            "price" => "required|integer",
            "email" => "required|string|email:strict,dns",
            "tel" => "required|regex:/^[0-9\-]+$/i",


        ];
    }
}
