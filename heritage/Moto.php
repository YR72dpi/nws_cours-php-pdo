<?php

class Moto extends Vehicule {
    private bool $aChicane;

    public function __construct($marque, $modele, $anneeFabrication, $couleur, $puissance, $aChicane,) {
        parent::__construct($marque, $modele, $anneeFabrication, $couleur, $puissance);
        $this->aChicane = $aChicane;
    }

    public function getDetails() {
        $detailsParent = parent::getDetails();
        $chicane = $this->aChicane ? "oui" : "non";
        return "$detailsParent, a un chicane: $chicane";
    }

    public function roulerEnY():void {
        echo "Roule en Y";
    }
}
