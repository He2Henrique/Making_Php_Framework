<?php

namespace App\controllers;

use App\core\Controller;
use App\core\Request;
use App\core\Application;
use App\models\ManagerClass;
use App\core\Data;

class SiteController extends Controller{
    public Application $app;

    public function home(){
        $data = new Data();
        $data = $data->getDataString();

        $connection = Application::$DatabaseConnetion;
        
        $conn = new ManagerClass($connection);
        $turmas = $conn->TurmasHJ();
        $aulas = $conn->AulasRealizadasHJ();

        $aulas_turmas_ragistradas = array_column($aulas, 'id_turma');

        $params = [
            'turmas' => $turmas,
            'data' => $data,
            'ocorrencias' => $aulas_turmas_ragistradas
        ];
        
        return $this->renderview('today_class', 'basic', $params);
    }

    public function handleData(Request $request){

        $body = $request->getBody();

        var_dump($body);

    }
    
}