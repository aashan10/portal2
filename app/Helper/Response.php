<?php
/**
 * Created by PhpStorm.
 * User: aashan10
 * Date: 3/11/19
 * Time: 2:21 PM
 */

namespace App\Helper;
use Illuminate\Support\Facades\Response as Reply;

class Response
{
    public static function success($message = null){
        return Reply::json([
            'status' => 'success',
            'message' => ($message!= null) ? $message : 'The action was successful!'
        ], 200);
    }

    public static function successWithData($message = null, $data = null){
        return Reply::json([
            'status' => 'success',
            'message' => ($message!= null) ? $message : 'The action was successful!',
            'data' => $data
        ], 200);
    }

    public static function error($message = null){
        return Reply::json([
            'status' => 'error',
            'message' => ($message!= null) ? $message : 'An error occurred!'
        ], 400);
    }

    public static function errorWithData($message = null, $data = null){
        return Reply::json([
            'status' => 'error',
            'message' => ($message!= null) ? $message : 'There was an error processing the data!',
            'data' => $data
        ], 422);

    }
    public static function errorContentNotFound($message = null){
        return Reply::json([
            'status' => 'error',
            'message' => ($message!= null) ? $message : 'The content you tried to access doesn\'t exist or has been deleted!'
        ], 404);
    }
    public static function errorUnprocessibleEntity($message = null){
        return Reply::json([
            'status' => 'error',
            'message' => ($message!= null) ? $message : 'Unprocessable Entity!'
        ], 422);
    } 
}