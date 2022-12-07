<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class phoneNumExclusion implements Rule
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
     * 電話番号のバリデーション.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // 携帯電話番号のチェック
        if (preg_match("/0[5789]0[-(]?\d{4}[-)]?\d{4}/", $value) === 1) {
            return false;
        }

        // 固定電話番号のチェック
        if (preg_match("/0(\d{1}[-(]?\d{4}|\d{2}[-(]?\d{3}|\d{3}[-(]?\d{2}|\d{4}[-(]?\d{1})[-)]?\d{4}/", $value) === 1) {
            return false;
        }
        
        // フリーダイヤルのチェック
        if (preg_match("/0((12|99|18|57)0[-(]?\d{3}[-)]?\d{3}|800[-(]?\d{3}[-)]?\d{4})/", $value) === 1) {
            return false;
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'メッセージに電話番号を記載することはできません。';
    }
}
