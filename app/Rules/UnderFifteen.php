<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UnderFifteen implements Rule
{
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
        $now = date('Ymd');
        $birthday = date('Ymd',strtotime($value));
        //年齢
        $age = floor(($now - $birthday) / 10000);
        return 15 <= $age;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '15歳以下はご利用になれません';
    }
}
