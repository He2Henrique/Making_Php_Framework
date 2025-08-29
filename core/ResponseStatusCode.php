<?php

namespace App\core;

class ResponseStatusCode{

    public function SetStatusCode(int $code){
        http_response_code($code);
    }
}