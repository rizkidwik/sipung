<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    static function success($data = [], $code = 200, array $header = []){
        return response()->json([
            'code' => $code,
            'success' => true,
            'message' => "Successfully",
            'data'  => $data
        ]);
    }

    static function error($data = [], $code = 400, array $header = []){
        return response()->json([
            'code' => $code,
            'success' => true,
            'message' => "Failed",
            'data'  => $data
        ]);
    }

    static function json($data = [], $code = 200, array $header = []) {
        return response()->json($data, $code, $header);
    }

}
