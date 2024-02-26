<?php


$x = 5; // portée globale
const app = "my App";
function myCart () {
    global $x;
    echo "<p>Le montant de la commande est de $x €</p>";
    echo "mon app se nomme ".app;
}
echo "x lu a l'exterieur: $x";
myCart();
//declarer une varaible a lexterieur de la fonction de fonctionne pas


?>