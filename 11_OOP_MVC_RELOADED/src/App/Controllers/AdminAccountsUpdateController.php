<?php
// namespace App\Controllers;

// use App\Models\UserManager;
// use App\Models\ContactManager;
// use App\Controllers\AbstractController;
// use App\Services\Authenticator;
// use App\Services\Utils;


// class AdminAccountsAddController extends AbstractController 
// {
//     public function __construct() {
//         if(!Authenticator::isRole("ROLE_ADMIN")){
//             header('Location: ?page=home'); // sera login quand on aura une page admin ???
//             die();
//         }
//         //des que le routeur fait un new controlle (router), ca fait cette fonction construct.
//         //On ne veut pas que tous les controlleurs redirigent les gens. Seulement
//     }
//     public function index() {
//         $state = [ 
//             "Auvergne-Rhône-Alpes",
//             "Bourgogne-Franche-Comté",
//             "Bretagne",
//             "Centre-Val de Loire",
//             "Corse",
//             "Grand Est",
//             "Hauts-de-France",
//             "Ile-de-France",
//             "Normandie",
//             "Nouvelle-Aquitaine",
//             "Occitanie",
//             "Pays de la Loire",
//             "Provence Alpes Côte d’Azur",
//             "Guadeloupe",
//             "Guyane",
//             "Martinique",
//             "Mayotte",
//             "Réunion"
//         ];
//         $isDone = false;
//         $ok_email = "";
//         $errors = [];
//         $email = "";
//         if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
//             header("Location:?page=home");
//             exit();
//         }
//         // copie conforme du code de contact, vérifier si fonctionne bien et ajouter rôle + rajout role
//         if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        
//             $email = Utils::inputCleaner($_POST['email']); 
//             $password = htmlentities(strip_tags($_POST['password'])); 
//             $password = password_hash($password, PASSWORD_DEFAULT);
//             // $errors = [];
//             $exists = false;
        
//             if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
//                 $errors[] = "Veuillez renseigner une adresse email valide svp";
//             }
        
//             //Vérifier si l'email est dans la bdd
//             // connexion à la bdd
//             $user = new UserManager();
//             $exists = $user->getUserByEmail($email);
            
//             // $db = Utils::connectDB();
//             // // on recherche si l'email est déjà dans la table user
//             // $query = $db->prepare("SELECT email FROM user WHERE email=:email"); 
//             // // bindParam permet de renseigner la requête afin de "protéger" le serveur SQL (contre injection)
//             // $query->bindParam(':email', $email);
//             // $query->execute();
//             // // // fetchColumn cible un résultat uniquement (on ne veut qu'un seul résultat pour arrêter la requête)
//             // $exists = $query->fetchColumn(); //false si aucun résultat n'est trouvé ?
//             // // error si existe déjà dans la bdd
//             if($exists){
//                 $errors[] = "Adresse email déjà utilisée";
//             }
//             $recup_role = htmlentities(strip_tags($_POST['roles']));
//             $role = [];
//             if($recup_role === "admin"){
//                 $role[] = "ROLE_ADMIN";
//                 $role[] = "ROLE_MEMBER";
//                 $role = json_encode($role);
        
//             }
//             else {
//                 $role[] = "ROLE_MEMBER";
//                 $role = json_encode($role);
//             }
        
        
//             // sil n'y a pas d'erreur on effectue l'insertion de l'utilisateur dans la bdd
//             if (empty($errors)){
//                 $user = new UserManager();
//                 $u=$user->insert([$email, $password, $role]);

//                 $user_id = $u->lastInsertId();
//                 // $sql = $db->prepare("INSERT INTO USER (email, password, roles) VALUES (:email, :password, :roles)");
//                 // $sql->bindParam(':email', $email); //eviter de recevoir info directement du formulaire, enlève toutes les entités html pour les nettoyer
//                 // $sql->bindParam(':password', $password); // ici on va le hasher !
//                 // $sql->bindParam(':roles', $role);
//                 // $sql->execute();
//                 // // on récupère l'identifiant de la dernière ligne insérée;
//                 // $user_id = $db->lastInsertID();
        
//                 $firstname = htmlentities(strip_tags($_POST['firstname']));
//                 $lastname = htmlentities(strip_tags($_POST['lastname']));
//                 $address1 = htmlentities(strip_tags($_POST['address1']));
//                 $address2 = htmlentities(strip_tags($_POST['address2']));
        
//                 $city = htmlentities(strip_tags($_POST['city']));
//                 $state = htmlentities(strip_tags($_POST['state']));
//                 $zip = htmlentities(strip_tags($_POST['zip']));
//                 $message = htmlentities(strip_tags(''));
//         //décalage d'écriture entre adress1 dans bdd et address1, dans form et ce document.
//                 $contact = new ContactManager();
//                 $contact->insert([$user_id, $firstname, $lastname,
//                 $address1, $address2, $city, $state, $zip, $message]);
//                 $isDone = true;
        
//             }      
//         }
        

//         $u = new UserManager();
//         $users = $u->getAll();

//         $template = './views/template_admin_accounts.phtml';
//         $this->render($template, [
//         'title' => 'User creation',
//         'users' => $users,
//         'state' => $state,
//         'isDone' => $isDone,
//         'errors' => $errors,
//         'ok_email' => $ok_email,
//         'email' => $email,
        
//         ]);
//     }
// }