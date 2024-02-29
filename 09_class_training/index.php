<?php
// pour forcer à n'invoquer qu'une seule fois la classe et éviter des conflits
require_once "Voiture.php";

echo "Immatriculation : ";
echo Voiture::IMMATRICULATION;

$titine = new Voiture("Renault", "Clio II", "Essence", "Bleue");
echo "couleur de titine : ";
echo $titine->couleur;
//erreur, on ne peut pas faire 
/*
echo $titine->qt_energie;
*/
//donc utiliser get
echo "Volume de carburant de titine : ";
echo $titine->getQtEnergie();

echo $titine->demarrer();
echo "Volume de actuel de carburant de titine : ";
echo $titine->getQtEnergie();

echo $titine->setQtEnergie(60);

echo "Volume de carburant de titine : ";
echo $titine->getQtEnergie();

echo $titine::gonflerPneu();