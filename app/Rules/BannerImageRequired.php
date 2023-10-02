<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Banner;

class BannerImageRequired implements Rule
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function passes($attribute, $value)
    {
        $dbCheck = Banner::where('id', $this->id)->first();
        if (empty($dbCheck->image)) {
            return !empty($value);
        }
        return true;
    }

    public function message()
    {
        return 'The Banner Image field is required.';
    }
}

