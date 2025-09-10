<?

use App\core\Application;


class Controller{

    public function render($view){
        Application::$app->router->render($view);
    }
    
}


?>