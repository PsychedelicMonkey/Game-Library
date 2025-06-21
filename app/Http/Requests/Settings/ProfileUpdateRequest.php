<?php

namespace App\Http\Requests\Settings;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->user()?->load('profile');

        return [
            'username' => ['required', 'string', 'max:255', Rule::unique(Profile::class)->ignore($user->profile->id)],
            'bio' => ['nullable', 'string', 'max:255'],
            'is_public' => ['required', 'boolean'],
        ];
    }
}
