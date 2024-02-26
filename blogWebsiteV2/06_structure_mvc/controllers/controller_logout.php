<?php 
//on détruit la session
session_destroy();

//on redirige vers la page d'accueil
header( "Location:?page=home" );

?> 
