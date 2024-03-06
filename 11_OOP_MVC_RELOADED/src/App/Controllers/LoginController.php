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
                // si l'ut a coché la case remember_me on lui cree un cookie.
                if(isset($_POST['remember_me'])){
                    $cookieData = serialize($_SESSION['user']); // transforme tableau en chaine de caractère, json encode aurait pu servir meme si cest un detournement de son utilisation première.
                    setcookie(CONFIG_COOKIE_NAME, $cookieData, time() +3600);
                }
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
