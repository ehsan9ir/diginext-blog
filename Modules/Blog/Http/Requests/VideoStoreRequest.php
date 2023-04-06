<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\User\Entities\User;

class VideoStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $regex = '/^https?:\/\/(?:www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b(?:[-a-zA-Z0-9()@:%_\+.~#?&\/=]*)$/';

        return [
            'user_id' => 'required|integer|exists:users,id',
            'title' => 'required|string|max:240|min:5',
            'url' => ['required', 'max:240', 'min:10', "regex:$regex"],
        ];
    }

    protected function prepareForValidation(): void
    {
        $user = User::findOrFail($this->header('User-id'));
        $this->merge(['user_id' => $user->id]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
