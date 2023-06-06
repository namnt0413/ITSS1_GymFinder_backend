<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Option;
use App\Services\OptionService;

class OptionController extends Controller
{
    private $OptionService;

    public function __construct( OptionService $OptionService){
        $this->OptionService = $OptionService;
    }

    public function all()
    {
        $options = $this->OptionService->getAllOptions();
        if ( $options ) {
            return response([
                'data' => $options,
                'message' => 'OK'
            ],200);
        } else {
            return response([
                'message' => 'Error'
            ],400);
        }
    }
}
