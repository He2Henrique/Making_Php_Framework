<?php

namespace Core;

class ResponseStatusCode{

    public function SetStatusCode(int $code){
        http_response_code($code);
    }
}