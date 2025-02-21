<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidEmailDomain implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $domain = substr(strrchr($value, "@"), 1); // Extract domain from email

        if (!checkdnsrr($domain, 'MX')) {
            $fail("The email domain '$domain' is invalid or does not have a mail server.");
        }
    }
}
