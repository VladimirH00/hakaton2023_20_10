<?php

namespace App\Http\Requests\User;

use App\Http\Requests\AbstractBaseApiRequest;
use Illuminate\Validation\Rule;

/**
 * Request форма для проверки данных логина
 */
class LoginUserRequest extends AbstractBaseApiRequest
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
            'email' => ['required', 'string', 'email', 'max:255', Rule::exists('users', 'email')],
            'code' => ['required', 'string'],
        ];
    }

    /**
     * Получить пользовательские имена атрибутов для формирования ошибок валидатора.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'email' => 'Электронная почта',
            'code' => 'Код',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            '*.required' => 'Поле является обязательным',
            '*.email' => 'Поле содержит не корректный формат почты',
            '*.exists' => 'Не корректное значение',
        ];
    }
}
