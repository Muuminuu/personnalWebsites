<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site modulaire avec php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"  crossorigin="anonymous">
    <style>
        #carousel img, #gallery div.card img {
            aspect-ratio: 16/10;
        }
    </style>
</head>
<body>
    <?php
    require("./header.php")
    ?>
    <main class="container-fluid">
        <?php
        $getPage = isset($_GET['page']) ? $_GET['page'] : 'home'; 
        //isset => si la variable page est définie dans l'url on la recupère,
        // sinon c'est 'home'.
        $path = "./pages/" .$getPage. ".php";
        // si le chemin du fichier existe, on le charge, autrement, on a un parcours vers home quui nous évite d'afficher une erreur (on aurait pu mettre page 404note found)
        $page = file_exists($path) ? $path : "./pages/home.php";
        // on définit le parcours pour charger la page souhaitée.
        include($page);
        // on charge la page souhaitée avec un include/require.
        ?>
    </main>
    <?php
    require("./footer.php")
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
</body>
</html>