<?php

 namespace App\Traits;

 trait ApiResponseTrait
 {

    protected function success($data = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data

        ], $code);
    }

    protected function error( string $message = 'error', int $code = 400)
    {
        return response()->json([
            'success' => false,
            'message' =>$message
            
            
        ], $code);
    }
 }