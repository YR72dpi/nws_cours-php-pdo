<?php

class Voiture extends Vehicule {
    private int $nombrePortes;

    public function __construct($marque, $modele, $anneeFabrication, $couleur, $puissance, $nombrePortes, ) {
        parent::__construct($marque, $modele, $anneeFabrication, $couleur, $puissance);
        $this->nombrePortes = $nombrePortes;
    }

    public function getDetails() {
        $detailsParent = parent::getDetails();
        return "$detailsParent, Nombre de portes: $this->nombrePortes";
    }

    public function ouvrirPorte():void {
        for ($i=0; $i < $this->nombrePortes; $i++) { 
            echo "Porte $i ouvertes";
        }
    }
}
