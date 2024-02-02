<?php


namespace App\Http\Helpers;


class ResponseHelper
{

    public static function success($data, $message)
    {
        return response()->json(
            [
                'status' => 'success',
                'message' => $message,
                'data' => $data,
            ]);
    }
    public static function error($data, $message , $code=400)
    {
        return response()->json(
            [
                'status' => 'error',
                'message' => $message,
                'data' => $data,
            ], $code); //422:  Unprocessable Content        
    }
}
