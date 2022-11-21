<?php

namespace App\Http\Requests\Api\Picture;

use App\Rules\NoSpecialChar;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StorePictureApiRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', 'max:20', new NoSpecialChar()],
            'description' => ['required', 'min:2', 'max:200'],
            'picture' => 'required|max:2048|mimes:jpeg,jpg,JPG,bmp,png'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()

        ]));
    }

    public function messages()
    {
        return [
            'name.required' => 'Pole Nazwa jest wymagane',
            'name.min' => 'Minimalna ilość znaków w polu Nazwa wynosi: 2',
            'name.max' => 'Maksymalna ilość znaków w polu Nazwa wynosi: 20',
            'description.required' => 'Pole Opis jest wymagane',
            'description.min' => 'Minimalna ilość znaków w polu Opis wynosi: 2',
            'description.max' => 'Maksymalna ilość znaków w polu Opis wynosi: 200',
            'picture.required' => 'Pole Zdjęcie jest wymagane',
            'picture.mimes' => 'Zdjęcie ma nieprawidłowy format. Obsługiwane są tylko pliki graficzne',
            'picture.max' => 'Zdjęcie jest za duże. Maksymalny rozmiar to 2MB',
        ];
    }
}
