<?php

Namespace App\RestfulApi;

class ApiResponse {

    private ?string $message=null;
    private mixed $data;
    private int $status = 200;
    private array $appends = [];
    public function setMessage(string $message): void{
        $this->message = $message;
    }
    public function setData(mixed $data): void{
        $this->data = $data;
    }
    public function setStatus(int $status): void{
        $this->status = $status;
    }
    public function setAppends(array $appends): void{
        $this->appends = $appends;
    }

    public function response(){
        $body=[];
        !is_null($this->message) && $body['message']=$this->message;
        !is_null($this->data) && $body['data']=$this->data;
        $body = $body + $this->appends;
        return response()->json($body,$this->status);

    }
}