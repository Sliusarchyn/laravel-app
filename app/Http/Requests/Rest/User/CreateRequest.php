<?php

declare(strict_types=1);

namespace App\Http\Requests\Rest\User;

use App\Rules\EmailRule;
use App\Rules\PhoneRule;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', new EmailRule()],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', new PhoneRule()],
        ];
    }
}
