<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InstructorAddRequest extends FormRequest
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
        if($this->input('byFile') != true) {
            $rule = [
                'id' => 'required|unique:instructors,id',
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'unit' => 'required|numeric',
            ];
        } else {
            $rule = [
                'file' => 'required|file',
            ];
        }
        return $rule;
    }
}
