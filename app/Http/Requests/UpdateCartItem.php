<?php

namespace App\Http\Requests;

class UpdateCartItem extends ApiRequest
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
            'cart_id' => 'required|integer',
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|between:1,10'
        ];
    }

    public function messges()
    {
        return [
            'required' => ':attribute 是必要的',
            'between' => ':attribute 的輸入 :input 不在 :min 和 :max 之間'
        ];
    }
}
