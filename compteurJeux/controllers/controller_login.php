<?php

// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";

// si le formulaire est validé
if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    // on se connecte à la base données
    // pour verifier si l'email est dans la table user,et si c'est le cas on récupère les datas de l'utilisateur
    $email = htmlentities(strip_tags($_POST['email']));
    $password = htmlentities(strip_tags($_POST['password']));

    $db = Utils::connectDB();
    $query = $db->prepare("SELECT user.*,user_detail.lastname,user_detail.firstname FROM user,user_detail  WHERE email=:email AND user.id=user_detail.user_id"); 
    $query->bindParam(':email', $email);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC); 
    // fetch_assoc donne moi les resultat sous fome associatif
    //false si aucun résultat n'est trouvé ?
    // error si existe déjà dans la bdd
    // permet d'afficher tous les champs de l'utilisteur à partir de la récupération de l'email.
    //fetchColumn ne retourne qu'un seul resultat.
    //fetch permet une personnalisation (ou reusltat simple...) versatile
    //fetch all recupère tout ?

    echo "<pre>";
    var_dump($user);
    echo "</pre>";

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
include "./views/base.phtml";
?>
