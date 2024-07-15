<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Grade implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Allow "not yet graded" or a numeric value between 60 and 100
        return $value === 'not yet graded' || (is_numeric($value) && $value >= 60 && $value <= 100);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be either "not yet graded" or a number between 60 and 100.';
    }
}

