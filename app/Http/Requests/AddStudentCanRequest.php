<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\AddStudentCanRequest;

class AddStudentCanRequest extends FormRequest
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
            $rule = $this->getManual();
        } else {
            $rule = $this->getFile();
        }
        return $rule;
    }

    public function getManual() {
        return [
            'id' => 'required'
            
        ];
    }

    public function getFile() {
        return [
            'file' => 'required|file',
        ];
    }
}
