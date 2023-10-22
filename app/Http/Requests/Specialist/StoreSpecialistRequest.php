<?php

namespace App\Http\Requests\Specialist;

use App\Http\Requests\AbstractBaseApiRequest;
use Illuminate\Support\Str as StrAlias;

/**
 * request для валидации формы которая приходит с клиента для создания Специалистов
 */
class StoreSpecialistRequest extends AbstractBaseApiRequest
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
     * @return void
     */
    protected function prepareForValidation()
    {
        $name = $this->get('name');
        if ($name) {
            $this->merge(['code' => StrAlias::slug($name)]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:1024'],
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
            'name' => 'Специалист',
            'description' => 'Описание специалиста',
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
        ];
    }
}
