<?php

namespace App\Traits;

trait ValidationRules
{
    function getNameValidationRules()
    {
        return [
            ['name' => 'required|min:3|max:255',],
            [
                'name.min' => 'A megnevezés legalább 3 karakter.',
                'name.max' => 'A megnevezés legfeljebb 255 karakter.',
                'name.required' => 'A megnevezést kötelező megadni!',
            ]
        ];
    }
}
