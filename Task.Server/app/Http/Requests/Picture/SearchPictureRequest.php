<?php

namespace App\Http\Requests\Picture;

use App\Rules\NoSpecialChar;
use Illuminate\Foundation\Http\FormRequest;

class SearchPictureRequest extends FormRequest
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
            'name' => ['required', 'min:2', 'max:20', new NoSpecialChar()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole Nazwa jest wymagane',
            'name.min' => 'Minimalna ilość znaków w polu Nazwa wynosi: 2',
            'name.max' => 'Maksymalna ilość znaków w polu Nazwa wynosi: 20',
        ];
    }
}
