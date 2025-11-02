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

#help to create a index.php 
# if public alredy exists crates index
# if both exists ask to user if they want to rewrite the index
?>