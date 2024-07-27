<?php

namespace App\Http\ApiRequest\Admin\User;
use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\RestfulApi\ApiFormRequest;
class UserUpdateApiRequest extends ApiFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return User::rules([
            'email' => ['required','email',Rule::unique('users', 'email')->ignore($this->user->id)],
            'password' => ['nullable', 'string', 'min:8', 'max:30'],
        ]);
    }
}
