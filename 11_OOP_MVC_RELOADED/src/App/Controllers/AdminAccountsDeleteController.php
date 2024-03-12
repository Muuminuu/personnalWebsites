<?php 

namespace App\Controllers;

use App\Models\UserManager;
use App\Models\ContactManager;
use App\Controllers\AbstractController;
use App\Services\Authenticator;
use App\Services\Utils;

class AdminAccountsDeleteController extends AbstractController
{
    public function __construct() {
        if(!Authenticator::isRole("ROLE_ADMIN")){
            header('Location: ?page=home'); // sera login quand on aura une page admin ???
            die();
        }
    }

    public function index() {
        
        $id = (int)$_GET['id'];
        $c = new ContactManager;
        $u = new UserManager;
        $c->delete();
        $u->delete();



        $template = './views/template_admin_accounts_add.phtml';
        $this->render($template, [

        ]);
    }




}
//verification si admin
if (!isset($_SESSION['user']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}


// echo "Attention suppression du post".$post_id;



$db = Utils::connectDB();
// $posts= [];
// $post est il nécessaire vu qu'existant dans autre page ?
if ($db){

    $sql2 = $db->prepare("DELETE FROM contact
                         WHERE user_id=:id");    
    $sql2->bindParam(':id', $id);    
    $sql2->execute();

    $sql = $db->prepare("DELETE FROM user
                         WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    // header("Location:?page=admin_accounts");
    // $posts = $sql->fetchAll(PDO::FETCH_ASSOC);


   

    header("Location:?page=admin_accounts");
}



?>