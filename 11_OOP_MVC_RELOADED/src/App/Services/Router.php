<?php

namespace App\Services;
/** 
 * very simple class Router
 * based on $_GET['page']
 * page => Controller, action => method
*/
class Router {
    private $page;
    private $action;
    /**
     *$page=contact&acion=new
     */

    public function __construct() {
        $this->setPage();
        $this->setAction();
    }

    public function setPage(){
        $this->page = isset($_GET['page']) ? strtolower($_GET['page']) : 'home';

    }

    public function getPage(){
        return $this->page;
    }

    public function setAction(){
        $this->action = isset($_GET['action']) ? strtolower($_GET['action']) : 'index';
    }

    public function getAction(){
        return $this->action;
    }

    public function run(){
        // on définit le controlleur par défaut et la méthode par défaut;
        $controllerName = "App\Controllers\\NotFoundController";
        $action = "index";

        // si le fichier par exemple App\Controllers\HomeController.php existe, alors on instancie la classe HomeController.
        if(file_exists("./src/App/Controllers/".ucfirst($this->getPage())."Controller.php")){
            $controllerName = "App\Controllers\\".ucfirst($this->getPage())."Controller"; // upper case first letter // exemple : App\Controllers\HomeController
        } 

        // si la méthode correspondante dans le controller existe, alors on execute cette méthode.
        if(method_exists($controllerName,$this->getAction())){
            $action = $this->getAction();
        }

        // On peut donc ensuite instancier note controller en faisant :
        $controller = new $controllerName(); // on instancie la classe du controller // $controller = new HomeController() // nom du controller est généré dynamiquement
        // on peut xecuter la methode correspondante
        $controller->$action();
        //permet d'avoir un contrlleur qui peut nous permettre de faire plein d'actions.
        
    }
}


// ucfirst pour la première lettre majuscule