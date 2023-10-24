<?php 

abstract class Vehicule {
    protected string $marque;
    protected string $modele;
    protected int $anneeFabrication;
    protected string $couleur;
    protected string $puissance;

    public function __construct(
        string $marque, 
        string $modele, 
        int $anneeFabrication,
        string $couleur,
        string $puissance
    ) {
        $this->marque = $marque;
        $this->modele = $modele;
        $this->anneeFabrication = $anneeFabrication;
        $this->couleur = $couleur;
        $this->puissance = $puissance;
    }

    public function getDetails() {
        return "Marque: $this->marque, Modèle: $this->modele, Année de Fabrication: $this->anneeFabrication";
    }

    public function start():void {
        echo "Vehicule en marche";
    }

    public function stop():void {
        echo "Vehicule arrété";
    }
}
