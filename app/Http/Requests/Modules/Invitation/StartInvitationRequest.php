<?php

namespace App\Http\Requests\Modules\Invitation;

use Illuminate\Foundation\Http\FormRequest;

class StartInvitationRequest extends FormRequest
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
            'invitation_code' => ['required','exists:student_invitations,invitation_code'],
            'questionnaire_id' => ['required','exists:questionnaires,id'],
            'student_id' => ['required','exists:students,id'],
        ];
    }
}
