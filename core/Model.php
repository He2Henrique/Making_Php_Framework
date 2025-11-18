<?php

namespace Core;


use Exception;
use Core\Repository;


class Model {

    protected Repository $repoinstance;
    
    public function __construct($repoinstance){
        
        $this->repoinstance = $repoinstance;

        $table_fields = $this->repoinstance->GetTableInfo();
        try{
            foreach ($table_fields as $value){
            
            if(!property_exists($this, $value['Field'])){
                throw new Exception("The property dont exists ´{$value['Field']}´");
            }
            var_dump($value['Field']);
           
            } 
        }catch(Exception $e){
            echo $e->getMessage();

        }
        
    }

    // //if is the right type, if is 
    // protected function validate($values){

        
    // }

    
}