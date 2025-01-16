

<?php

    require_once '../database/db.php';
    class Tags {
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


        public function afficherTags() {
            try {
                $sql = "SELECT * FROM tags";
                $stmt = $this->db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "error: " . $e->getMessage();
            }
        }
        
        
 





        
    }











