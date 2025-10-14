<?php

$path = __DIR__.'/../foulder_test';

if(!is_dir($path)){
    if(mkdir($path, 0777, true)){
        echo "the $path was successfully";
    }else{
        echo "theres a erro during create this new file";
    }

}else{
    echo "The $path already exist";
}


?>