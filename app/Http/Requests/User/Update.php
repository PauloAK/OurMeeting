<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Just let edit Users if is an Admin
        return Auth::user()->admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route('user')->id;

        return [
            'name' => 'required|string',
            'email' => "required|email|unique:users,email,{$id}",
            'phone' => 'required|regex:/\(?\d{2,}\)?[ -]?\d?[ ]\d{4}[\-\s]\d{4}/',
            'department' => 'required|exists:departments,id',
            'current_password' => 'nullable|string',
            'new_password' => 'required_with:current_password|nullable|confirmed|min:6',
        ];
    }
}
