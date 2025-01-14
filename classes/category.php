
<?php

    include_once '../database/db.php';

    class Category{
        private  $id_category;
        private  $nom;
        private  $description;
    
        private $db;

        public function __construct($db)
        {
            $this->db=$db;
        }

        public function getId(){
            return $this->id_category;
        }
        public function getNom(){
            return $this->nom;
        }
        public function getDescription(){
            return $this->description;
        }
      


        public function setNom($nom){
            $this->nom = $nom;
        }
        public function setDescription($description){
            $this->description = $description;
        }
     

    }

