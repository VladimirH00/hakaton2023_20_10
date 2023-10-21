<?php

namespace App\Http\Requests\Meeting;

use App\Http\Requests\AbstractBaseApiRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str as StrAlias;


class UpdateMeetingRequest extends AbstractBaseApiRequest
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
            'code' => ['required','string', 'max:255'],
            'ord' => ['integer'],
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
            'name' => 'Встреча',
            'code' => 'Краткое название',
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
