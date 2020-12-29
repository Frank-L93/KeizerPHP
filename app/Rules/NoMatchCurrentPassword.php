<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use  Jantinnerezo\LivewireAlert\LivewireAlert;

class NoMatchCurrentPassword implements Rule
{
    use LivewireAlert;
    
    public $passed = true;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::find(auth()->id());
        if(Hash::check($value, $user->password) == TRUE)
        {
            $this->passed = false;
            return false;
        }
        else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if($this->passed == false){
            
            return trans('auth.SameCurrentPassword');
        }
    }
}
