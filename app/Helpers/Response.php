<?php
namespace App\Helpers;

class Response{
    protected $status;
    protected $data;
    protected $message;
    protected $statusCode;

    public function message(string $status = 'success', string $message = '', array $data = [], int $status_code = 200){
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;
        $this->statusCode = $status_code;
        return $this->send();
    }
    public function send(){
        return response()->json([
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->data
        ], $this->statusCode);
    }

}
    