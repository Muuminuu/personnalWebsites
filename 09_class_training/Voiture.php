<?php

class Voiture {
    const IMMATRICULATION = "AB-123-CD";
    // permet de forcer le type d'une propriété
    public ?string $marque;
    public ?string $modele = "";
    public $energie = "";
    public $couleur = "";
    private ?int $qt_energie = 30;

    public function __construct($marque, $modele, $energie, $couleur) {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->energie = $energie;
        $this->couleur = $couleur;
    }

    public function demarrer() {
        for ($i=$this->qt_energie; $i>=0;$i--){
        echo "<p>Vroum vroum</p>";
        }
        $this->qt_energie=$i;

        // $this->qt_energie-=10;
    }

    public function getQtEnergie() {
        return $this->qt_energie;
    }

    public function setQtEnergie($qt){
        $this->qt_energie+=$qt;
    }

    public static function gonflerPneu(){
        echo "<p>Gonfle le pneu</p>";
    }
    
}