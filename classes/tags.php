

<?php

    require_once '../database/db.php';
    class Tag {
        private $id;
        private $nom;

        private $db;
        public function __construct($db)
        {
            $this->db=$db;
        }
        // Getters
        public function getId() {
            return $this->id;
        }
        public function getNom() {
            return $this->nom;
        }

        // Setters
        public function setNom($nom) {
            $this->nom = $nom;
        }


        
    }











