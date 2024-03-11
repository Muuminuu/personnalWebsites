<?php
// met dehors les ens pas admin
if (!isset($_SESSION['user']['roles']) || !in_array("ROLE_ADMIN",json_decode($_SESSION['user']['roles']))){
    header("Location:?page=home");
    exit();
}

$id = htmlentities(strip_tags($_GET['id']));

$db = Utils::connectDB();
$user= [];
if ($db){
    $sql = $db->prepare("SELECT *, user.id as id,contact.id as contact_id FROM user inner JOIN contact on contact.user_id = user.id where user.id = :id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $user = $sql->fetch(PDO::FETCH_ASSOC);
}
$user_role = str_contains($user['roles'], 'ROLE_ADMIN');
if($user_role){
    $user_role = 'admin';
}else{
    $user_role = 'member';
}

// Utils::dump($user);




if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['address1']) && isset($_POST['address2']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['roles'])) {
    
    $firstname = htmlentities(strip_tags($_POST['firstname']));
    $lastname = htmlentities(strip_tags($_POST['lastname']));
    $email = htmlentities(strip_tags($_POST['email']));
    $address1 = htmlentities(strip_tags($_POST['address1']));
    $address2 = htmlentities(strip_tags($_POST['address2']));
    $city = htmlentities(strip_tags($_POST['city']));
    $state = htmlentities(strip_tags($_POST['state']));
    $zip = htmlentities(strip_tags($_POST['zip']));

    $roles[] = 'ROLE_MEMBER';

    if ($_POST['roles'] === 'admin'){
        $roles[] = 'ROLE_ADMIN';
    }

        $sql2 = $db->prepare("UPDATE contact SET firstname = :firstname, lastname = :lastname, address1 = :address1, address2 = :address2, city = :city, state = :state, zip = :zip WHERE user_id = $id");
        $sql2->bindParam(':firstname', $firstname);
        $sql2->bindParam(':lastname', $lastname);
        $sql2->bindParam(':address1', $address1);
        $sql2->bindParam(':address2', $address2);
        $sql2->bindParam(':city', $city);
        $sql2->bindParam(':state', $state);
        $sql2->bindParam(':zip', $zip);
        $sql2->execute();
        $roles = json_encode($roles);
        $sql3= $db->prepare("UPDATE user SET roles = :roles, email = :email WHERE id = $id");
        $sql3->bindParam(':roles', $roles);
        $sql3->bindParam(':email', $email);
        $sql3->execute();
        header("Location: ?page=admin_accounts");
    }
// }

include "./views/base.phtml";

?>