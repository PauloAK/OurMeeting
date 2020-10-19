<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Just let create Users if is an Admin
        return Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|regex:/\(?\d{2,}\)?[ -]?\d?[ ]\d{4}[\-\s]\d{4}/',
            'password' => 'required|string|confirmed',
            'department' => 'required|exists:departments,id'
        ];
    }
}
