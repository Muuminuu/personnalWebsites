<?php
namespace App\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Services\Utils;

class LoginController{
    public function index(){

        $title = "Page Login";

        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            // on se connecte à la base données
            // pour verifier si l'email est dans la table user,et si c'est le cas on récupère les datas de l'utilisateur
            $email = htmlentities(strip_tags($_POST['email']));
            $password = htmlentities(strip_tags($_POST['password']));
        
            $u = new User;
            $user = $u->login($email, $password);
            // $db = Utils::connectDB();
            // $query = $db->prepare(); 
            // $query->bindParam(':email', $email);
            // $query->execute();
        
            // $user = $query->fetch(PDO::FETCH_ASSOC); 
            // fetch_assoc donne moi les resultat sous fome associatif
            //false si aucun résultat n'est trouvé ?
            // error si existe déjà dans la bdd
            // permet d'afficher tous les champs de l'utilisteur à partir de la récupération de l'email.
            //fetchColumn ne retourne qu'un seul resultat.
            //fetch permet une personnalisation (ou reusltat simple...) versatile
            //fetch all recupère tout ?
        
            // echo "<pre>";
            // var_dump($u);
            // echo "</pre>";
        
            $errors = [];
        
            if (is_array($user) && password_verify($password,$user['password'])) {
                //echo "Yes !";
                unset($user['password']);
                $_SESSION['user']=$user;
                if(in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))) {
                    header("location:?page=admin");
                    exit();
                    }
                header("location:?page=home");
            }
            else{
                $errors[] = "Mauvaise saisie mot de passe ou email";
            }
        
        }

        $template = './views/template_login.phtml';
        $this->render($template,['title'=>$title,'errors'=>$errors,'user'=>$user]);
    }

    public function render($templatePath, $data){
        ob_start(); // ouvrir la mémoire tampon du serveur -> va mémorise ce qui suit.
        include $templatePath; // on charge la mémoire tampon dans le template.
        $template = ob_get_clean(); // nettoie la mémoire tampon;
        include './Views/base.phtml';
    }
}