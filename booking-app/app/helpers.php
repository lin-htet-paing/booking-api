<?php

use Illuminate\Http\JsonResponse;
use Mockery\Matcher\Any;

if (!function_exists('prepareForPresentation')) {
    /**
     * prepare for views
     * @param any $userData
     * @param string $errorMsg
     * @return JsonResponse
     */
    function prepareForPresentation($data, $errorMsg) :JsonResponse
    {
        $conditionsType = gettype($data) != 'Collection' ? $data : count($data) > 0;
        return $conditionsType ? response()->json([
            "status" => "success",
            "userData" => $data
        ], 200) :
            response()->json([
                "status" => "error",
                "errorMsg" => $errorMsg
            ], 400);
    }
}