<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    







<?php

//on initialise un tableau d'erreurs potentielles vide au départ
$errors = [];
//si la variable avatar arrive par le biais de la methode FILES (le formulaire est validé) on copie le fichier $_FILES['avatar'] dans le dossier "uploads" 

if (isset($_FILES['avatar'])) {
    // si l'un des champs est vide, on génére un erreur
    if(empty($_POST['name']) || empty($_POST['password']) ||empty($_POST['email']) || empty($_FILES['avatar']['name']) )
    {
        $errors[] = 'Tous les champs sont obligatoires, merci';
    }
    //on définit les types MIME acceptés
    $accepted = ['image/png','image/jpeg','text/csv'];
    // si le type de fichier n'existe pas dans la liste des types acceptés, on ajoute l'erreur correspondante
    if(!in_array($_FILES['avatar']['type'], $accepted)) {
        $errors[] =  "Le format du fichier (".$_FILES['avatar']['type'].") est invalide.";
    }
    
    // on va transformer le nom de fichier en tableau array afin d'extraire l'extension
    $arrayName = explode( ".", $_FILES['avatar']['name']);

    $extension = end($arrayName);
    //on définit un nouveau nom
    $newFile = "./uploads/avatar_".time().".$extension";
    // si le tableau des erreurs est vide : on copie
    

    if (empty($errors)){
        echo "<h1>Le fichier a été uploadé</h1>";
        move_uploaded_file($_FILES['avatar']['tmp_name'],$newFile);
    };
    // on copie le fichier temporaire de $_FILES['avatar'] dans le dossier uploads avec son nouveau nom. 

}

echo "<pre>";
var_dump($GLOBALS);
echo "</pre>"

?>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <label for="name">Nom*</label>
    <input type="text" name="name" id="name" required>

    <label for="email">Email*</label>
    <input type="text" name="email" id="email" required>

    <label for="password">Password*</label>
    <input type="password" name="password" id="password" >
    <input type="file" multiple name="avatar" id="">
    <input type="submit" value="Envoyer">

</form>


</body>
</html>