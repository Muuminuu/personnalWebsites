<?php
 namespace App\Controllers;

 use App\Services\Authenticator;
 use App\Controllers\AbstractController;

class LoginController extends AbstractController
{
    public function index(){

        $errors = [];
        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            $email = htmlentities(strip_tags($_POST['email']));
            $password = htmlentities(strip_tags($_POST['password']));
            $auth = new Authenticator();
            if ($auth->login($email,$password)){
                header('Location: ?page=admin');
                die();
            }
            $errors[] = "Email ou mot de passe incorrect";
        
        }

        $title = "Login Page";
        $template = './views/template_login.phtml';
        $this->render($template,[
            'errors' => $errors,
            'title' => $title
        ]);
    }
}













// include "./views/base.phtml";
?>
