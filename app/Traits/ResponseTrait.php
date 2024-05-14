<?php
namespace App\Traits;

trait ResponseTrait
{

    public function sendSuccessResponse($message, $data = null, $code = 200)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], $code);
    }



    public function sendErrorResponse($message, $error, $code = 400)
    {
        return response()->json([
            'message' => $message,
            'error' => $error,
        ], $code);
}
}
