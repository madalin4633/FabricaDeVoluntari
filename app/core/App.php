<?php

class App {
    private $controller = 'home'; // default controller
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
    }

    private function executeController($url) {
        // $url[0] este numele controllerului, primul segment din url de dupa domeniu
        if(isset($url[0]) && file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')){
            $this -> controller = $url[0];
            $this -> params = array_slice($url, 1); // daca controllerul exista, elimina primul element din tabloul param
        }

        // numele metodei, daca este definita in controller
        if(isset($url[1]) && method_exists($this->controller, $url[1])){
            $this -> method = $url[1];
            $this -> params = array_slice($url, 2);
        }

        require_once __DIR__ . '/../controllers/' . $this -> controller . '.php';
        $controller = new $this->controller();

        $controller -> index();        
    }

    private function parseUrl($url) {
        $trimmedUrl = rtrim($url, '/');

        return explode('/', $url);
    }
}
?>