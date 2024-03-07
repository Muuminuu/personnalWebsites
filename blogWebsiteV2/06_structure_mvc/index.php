
    <?php
    
    session_start();
    
    // session_destroy();
    // charger la config
        require "./config.php";
    // ici un chargement du router (considéré comme un service)
        require "./services/router.php";
    // on charge le controller
        require "./controllers/controller_{$page}.php";
        
    ?>
