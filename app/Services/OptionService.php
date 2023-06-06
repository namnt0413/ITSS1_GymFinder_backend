<?php
namespace App\Services;

use App\Models\Option;
use Carbon\Carbon;

class OptionService
{
    public function getAllOptions()
    {
        $options = Option::all();
        return $options;
    }

}
