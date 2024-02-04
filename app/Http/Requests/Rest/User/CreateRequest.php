<?php

declare(strict_types=1);

namespace App\Http\Requests\Rest\User;

use App\Rules\PhoneRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'between:3,255'],
            'phone' => ['required', new PhoneRule()],
        ];
    }
}
