<?php


class App {
    private $controller = 'volunteer'; // default controller
    private $method = 'index'; // default view

    private $params =[];

    public function __construct()
    {
       
        $url = [];
        if(isset($_GET['url'])) {
            $url = $this -> parseUrl($_GET['url']);
        }

        $this -> params = $url;

        // redirect to api or to controller?
        if (isset($url[0]) && $url[0] == "api") 
        {
            require_once __DIR__ . '/../api/rest/rest-service.php';
            $APIRestClass = new RestService();
        }
        else
            $this -> executeController($url);

        pg_close($GLOBALS['db']);
    }

    private function executeController($url) {
        // $url[0] este numele controllerului, primul segment din url de dupa domeniu
        if(isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')){
            $this -> controller = $url[0];
            $this -> params = array_slice($url, 1); // daca controllerul exista, elimina primul element din tabloul param
        }
        else if(isset($url[0]) && $url[0] != ""){
            require_once __DIR__ . "/../views/not-found.html";
            return;
        }

        require_once __DIR__ . '/../controllers/' . $this -> controller . '.php';
        $controller = new $this->controller();

        // numele metodei, daca este definita in controller
        if(isset($url[1]) && method_exists($controller, $url[1])){
            $this -> method = $url[1];
            $this -> params = array_slice($url, 2);
        }

        $method = $this->method;

        if (method_exists($controller, $this->method))
            $controller->$method($this -> params);
    }

    private function parseUrl($url) {
        $trimmedUrl = rtrim($url, '/');

        return explode('/', $url);
    }

    // Load view
    public function view($view, $data = []){
        // Check for view file
        if(file_exists(__DIR__ .'/../views/' . $view . '.php')){
          require_once __DIR__ .'/../views/' . $view . '.php';
        } else {
          // View does not exist
          die('View does not exist');
        }
      }

      public function model($model){
        
        require_once __DIR__.'/../models/' . $model . '.php';
       
        return new $model();
      }
}
?>