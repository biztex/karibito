<?php

namespace App\Http\Requests\ChatroomController;

use App\Rules\EmailExclusion;
use App\Rules\phoneNumExclusion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTrashFlgRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
      return [
        'trash_flg' => 'required | integer'
    ];
    }
}
