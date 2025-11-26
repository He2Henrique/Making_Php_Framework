<?php

namespace Core;


use Exception;
use Core\Repository;

class Model {

    protected Repository $repoinstance;
    
    public function __construct($post){
        foreach ($post as $key => $value){
            if(!property_exists($this, $key)){
                throw new Exception("The property dont exists ´{$key}´");
            }
            $this->$key = $value;
        }
        
    }

    public function Getf_HTML($atribute){
        if(!property_exists($this, $atribute)){
            throw new Exception("The property dont exists ´{$atribute}´");
        }
        if(!isset($this->$atribute)){
            return null;
        }
        return htmlspecialchars($this->$atribute);
    }


    public function set_repository(Repository $repoinstance){
        $this->repoinstance = $repoinstance;
    }


    /* this(check) function check if all the colums in the database exits in the propert in the class */
    public function check(){

        $table_fields = $this->repoinstance->GetTableInfo();
        try{
            foreach ($table_fields as $value){
            
            if(!property_exists($this, $value['Field'])){
                throw new Exception("The property dont exists ´{$value['Field']}´");
            }
           
            } 
        }catch(Exception $e){
            return $e->getMessage();
        }
    }

    // //if is the right type, if is 
    // protected function validate($values){

        
    // }

    
}