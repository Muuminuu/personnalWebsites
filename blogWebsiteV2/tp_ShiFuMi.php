<?php

    $shifumi = ['pierre','ciseaux','feuille'];
    $random = rand(0,2);
    $tirage = $shifumi[$random];
    $tirJoueur = $_GET["select"];
    
        if ($tirage != $tirJoueur){
            if (
                ($tirJoueur == 'pierre' && $tirage == 'feuille' )
            ||  ($tirJoueur == 'feuille' && $tirage == 'ciseaux' )
            ||  ($tirJoueur == 'ciseaux' && $tirage == 'pierre')
            )
            {
                echo "Aie, vous avez perdu, Votre ".$tirage." plus fort que ".$tirJoueur." !";
            }
            else
            {
                echo "Vous avez gagné ! Votre ".$tirJoueur." plus fort que ".$tirage.".";
            }
        }
        else{
            echo "Egalité!";
        }

?>
    <form method="GET">
        <select name="select">
            <option value='pierre'>pierre</option>
            <option value='ciseaux'>ciseaux</option>
            <option value='feuille'>feuille</option>
        </select>
        <input type="submit" value='Envoyer'>
    </form>

<?php
  // correction
    //else ;
    //$choices = ["rock","scissors","paper"];
    //$rand = rand(0,2);

    
  
    //switch(){

    //}

    ?>
