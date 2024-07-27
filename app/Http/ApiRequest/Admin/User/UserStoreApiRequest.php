<?php

namespace App\Http\ApiRequest\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use App\RestfulApi\ApiFormRequest;
class UserStoreApiRequest extends ApiFormRequest
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
        return User::rules();
    }
}
