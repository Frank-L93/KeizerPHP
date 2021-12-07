<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePresenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        if ($this->input('admin') == 1) {

            if ($this->input('change') == 1) {

                if ($this->input('availability') == 0) {
                    return [
                        'reason' => 'required',
                        'availability' => 'required',
                        'change' => 'required',
                        'round' => 'required',
                        'user_form' => 'required',
                    ];
                } else {
                    return [
                        'availability' => 'required',
                        'change' => 'required',
                        'round' => 'required',
                        'user_form' => 'required',
                    ];
                }
            }
            if ($this->input('availability') == 0) {
                return [
                    'date' => 'required',
                    'reason' => 'required',
                    'availability' => 'required',
                    'user_form' => 'required',
                ];
            } else {
                return [
                    'date' => 'required',
                    'availability' => 'required',
                    'user_form' => 'required',
                ];
            }
        } else {
            if ($this->input('change') == 1) {
                if ($this->input('availability') == 0) {
                    return [
                        'reason' => 'required',
                        'availability' => 'required',
                        'change' => 'required',
                        'round' => 'required',
                    ];
                } else {
                    return [
                        'availability' => 'required',
                        'change' => 'required',
                        'round' => 'required',
                    ];
                }
            }
            if ($this->input('availability') == 0) {
                return [
                    'date' => 'required',
                    'reason' => 'required',
                    'availability' => 'required',
                ];
            } else {
                return [
                    'date' => 'required',
                    'availability' => 'required',
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'date.required' => 'Een ronde is verplicht om te kiezen. Let op dat er op de betreffende datum een ronde is!',
            'availability.required' => 'Kies een aanwezigheidssoort (Aan- of afwezig)',
            'reason.required' => 'Een reden is verplicht te vullen in het geval van afwezigheid',
            'round.required' => 'Het is verplicht om de ronde te kunnen vullen. Gebeurd op de achtergrond, als dit fout gaat, neem contact op met Frank.',
            'change.required' => 'Bij het wijzigen van een aan- of afwezigheid is een check noodzakelijk. Deze gaat fout, neem contact op met Frank',
            'admin.required' => 'Er gaat iets goed fout.',
            'user.required' => 'Het is verplicht een gebruiker te kiezen!',
        ];
    }
}
