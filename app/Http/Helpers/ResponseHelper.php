<?php


namespace App\Http\Helpers;


class ResponseHelper
{
    public static function success($data, $message)
    {
        return response()->json([
            'status' => [
                'original' => [
                    'ok' => true,
                    'msg' => $message
                ]
            ],
            'data' => $data
        ]);
    }
}
