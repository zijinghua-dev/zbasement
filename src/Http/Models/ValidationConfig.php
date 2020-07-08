<?php


namespace Zijinghua\Zbasement\Http\Models;

use Illuminate\Support\Collection;
use Zijinghua\Zbasement\Http\Models\Contracts\ValidationModelInterface;

class ValidationConfig implements ValidationModelInterface
{
    public function rules($slug){
        $rules=config('zbasement.validation.rules.'.$slug);
        return $rules;
    }

    public function messages($slug){
        $rules=config('zbasement.validation.messages.'.$slug);
        return $rules;
    }
}