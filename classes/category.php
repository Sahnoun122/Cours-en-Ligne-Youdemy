
<?php

    include_once '../database/db.php';

    class Category{
        private  $id_category;
        private  $nom;
    
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
     
      
        public function setNom($nom){
            $this->nom = $nom;
        }
    
        public function affichercategory(){
            try{
                 $sql= "SELECT * FROM Category ";
                 $stmt = $this->db->prepare($sql);
                 $stmt->execute();
                 return $stmt->fetchALL(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "Errore" .$e->getMessage();
            }
           }

     

    }

