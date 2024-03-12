<?php
namespace App\Controllers;

use App\Models\UserManager;
use App\Models\ContactManager;
use App\Controllers\AbstractController;
use App\Services\Authenticator;
use App\Services\Utils;

class AdminAccountsController extends AbstractController 
{
    public function __construct() {
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
        //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
        //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
    }
    public function index() {
        $u = new UserManager();
        $users = $u->getAll();

        $template = './views/template_admin_accounts.phtml';
        $this->render($template, [
        'title' => 'Welcome to the Admin Dashboard',
        'users' => $users,
        ]);
    }

    public function create()
    {
        $manager = new UserManager();
        $state = [ 
            "Auvergne-Rhône-Alpes",
            "Bourgogne-Franche-Comté",
            "Bretagne",
            "Centre-Val de Loire",
            "Corse",
            "Grand Est",
            "Hauts-de-France",
            "Ile-de-France",
            "Normandie",
            "Nouvelle-Aquitaine",
            "Occitanie",
            "Pays de la Loire",
            "Provence Alpes Côte d’Azur",
            "Guadeloupe",
            "Guyane",
            "Martinique",
            "Mayotte",
            "Réunion"
        ];
        $isDone = false;
        $ok_email = "";
        $errors = [];
        $email = "";
        if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
            header("Location:?page=home");
            exit();
        }
        // copie conforme du code de contact, vérifier si fonctionne bien et ajouter rôle + rajout role
        if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        
            $email = Utils::inputCleaner($_POST['email']); 
            $password = htmlentities(strip_tags($_POST['password'])); 
            $password = password_hash($password, PASSWORD_DEFAULT);
            // $errors = [];
            $exists = false;
        
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors[] = "Veuillez renseigner une adresse email valide svp";
            }

            $user = new UserManager();
            $exists = $user->getUserByEmail($email);

            if($exists){
                $errors[] = "Adresse email déjà utilisée";
            }
            $recup_role = htmlentities(strip_tags($_POST['roles']));
            $role = [];
            if($recup_role === "admin"){
                $role[] = "ROLE_ADMIN";
                $role[] = "ROLE_MEMBER";
                $role = json_encode($role);
            }
            else {
                $role[] = "ROLE_MEMBER";
                $role = json_encode($role);
            }
        
            // sil n'y a pas d'erreur on effectue l'insertion de l'utilisateur dans la bdd
            if (empty($errors)){
                $user = new UserManager();
                $u=$user->insert([$email, $password, $role]);

                $user_id = $u->lastInsertId();
                $firstname = htmlentities(strip_tags($_POST['firstname']));
                $lastname = htmlentities(strip_tags($_POST['lastname']));
                $address1 = htmlentities(strip_tags($_POST['address1']));
                $address2 = htmlentities(strip_tags($_POST['address2']));
        
                $city = htmlentities(strip_tags($_POST['city']));
                $state = htmlentities(strip_tags($_POST['state']));
                $zip = htmlentities(strip_tags($_POST['zip']));
                $message = htmlentities(strip_tags(''));
        //décalage d'écriture entre adress1 dans bdd et address1, dans form et ce document.
                $contact = new ContactManager();
                $contact->insert([$user_id, $firstname, $lastname,
                $address1, $address2, $city, $state, $zip, $message]);
                $isDone = true;
            }      
        }
        
        $u = new UserManager();
        $users = $u->getAll();

        $template = './views/template_admin_accounts.phtml';
        $this->render($template, [
        'title' => 'User creation',
        'users' => $users,
        'state' => $state,
        'isDone' => $isDone,
        'errors' => $errors,
        'ok_email' => $ok_email,
        'email' => $email,
        
        ]);
    }
    

    public function delete() {
        $account_id = (int)$_GET['id'];
        $manager = new UserManager();
        $delete = $manager->delete($account_id);

        header("Location:?page=adminaccounts");
    }

    public function update() {
        $state = [ 
            "Auvergne-Rhône-Alpes",
            "Bourgogne-Franche-Comté",
            "Bretagne",
            "Centre-Val de Loire",
            "Corse",
            "Grand Est",
            "Hauts-de-France",
            "Ile-de-France",
            "Normandie",
            "Nouvelle-Aquitaine",
            "Occitanie",
            "Pays de la Loire",
            "Provence Alpes Côte d’Azur",
            "Guadeloupe",
            "Guyane",
            "Martinique",
            "Mayotte",
            "Réunion"
        ];
        $isDone = false;
        $ok_email = "";
        $errors = [];
        $email = "";

        if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
            header("Location:?page=home");
            exit();
        }
        $this_id = $_GET['id'];
        var_dump($this_id)   ;

        $u = new UserManager();
        $this_user = $u->getOneUserAndContact($this_id);
        var_dump($this_user)   ;

        if(isset($_POST['email']) && !empty($_POST['email'])) {
        
            $email = Utils::inputCleaner($_POST['email']); 
        //     $password = htmlentities(strip_tags($_POST['password'])); 
        //     $password = password_hash($password, PASSWORD_DEFAULT);
            $exists = false;

            $user = new UserManager();
            $exists = $user->getUserByEmail($email);
            
            if($exists && $email!=$this_user['email']){
                $errors[] = "Adresse email déjà utilisée";
            }
            $recup_role = htmlentities(strip_tags($_POST['roles']));
            $role = [];
            if($recup_role === "admin"){
                $role[] = "ROLE_ADMIN";
                $role[] = "ROLE_MEMBER";
                $role = json_encode($role);
            }
            else {
                $role[] = "ROLE_MEMBER";
                $role = json_encode($role);
            }

            $id = (int)$_GET['id'];
            var_dump($id);
            if (empty($errors)){
                $user = new UserManager();
                $u=$user->updateAdam("UPDATE user SET email = ?, roles = ? WHERE id = $this_id", [$email, $role]);
                // version avec ? deux autres existent
                $user_id = $u->lastInsertId();
        
                $firstname = htmlentities(strip_tags($_POST['firstname']));
                $lastname = htmlentities(strip_tags($_POST['lastname']));
                $address1 = htmlentities(strip_tags($_POST['address1']));
                $address2 = htmlentities(strip_tags($_POST['address2']));
                $city = htmlentities(strip_tags($_POST['city']));
                $state = htmlentities(strip_tags($_POST['state']));
                $zip = htmlentities(strip_tags($_POST['zip']));
                $message = htmlentities(strip_tags(''));

                // $contact->update($id, [$user_id, $firstname, $lastname,
                // $address1, $address2, $city, $state, $zip, $message]);
                // $isDone = true;


                $u_a = new ContactManager();
                $this_user_a = $u_a->updateAdam("UPDATE contact SET firstname = :firstname, lastname = :lastname, address1 = :address1, address2 = :address2, city = :city, state = :state, zip = :zip WHERE user_id = $this_id", ["firstname" => $firstname, "lastname" => $lastname, "address1" => $address1, "address2" => $address2, "city" => $city, "state" => $state, "zip" => $zip]);
                header("Location:?page=adminaccounts");
            }      
        // }

        
            }
// faire l'updateAdam
        $template = './views/template_admin_accounts_update.phtml';
        $this->render($template, [
        'title' => 'User creation',
        'this_id' => $this_id,

        
        'user' => $this_user,
        'state' => $state,
        'isDone' => $isDone,
        'errors' => $errors,
        'ok_email' => $ok_email,
        'email' => $email,
        
        ]);
    }
}