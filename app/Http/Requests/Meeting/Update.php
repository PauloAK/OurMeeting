<?php

namespace App\Http\Requests\Meeting;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'room' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
            'start_time'  => 'required|date_format:H:i',
            'end_date' => 'required|date|after_or_equal:today',
            'end_time'  => 'required|date_format:H:i',
        ];
    }
}
