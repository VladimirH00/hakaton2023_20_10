<?php

namespace App\Http\Requests\User;

use App\Http\Requests\AbstractBaseApiRequest;
use Illuminate\Validation\Rule;

/**
 * request для валидации формы которая приходит с клиента для создания Пользователя
 */
class StoreUserRequest extends AbstractBaseApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /** todo сделать проверку на профиль */
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
            'firstname' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'patronymic' => ['string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'birthday' => ['required', 'date', 'date_format:Y-m-d'],
            'profileCode' => ['required', 'string', Rule::exists('spr_profiles', 'code')],
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
            'firstname' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'birthday' => 'Дата рождения',
            'profileCode' => 'Профиль пользователя',
            'email' => 'Электронная почта',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            '*.max' => 'Не корректное значение. Поле не должно содержать более :max символов',
            '*.required' => 'Поле является обязательным',
            '*.date_format' => 'Некорректный формат поля',
            '*.string' => 'Поле должно быть строкой',
            '*.email' => 'Поле содержит не корректный формат почты',
            '*.exists' => 'Не корректное значение',
        ];
    }
}
