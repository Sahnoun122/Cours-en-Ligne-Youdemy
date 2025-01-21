

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


        
function ajoutertags($id_admin, $tag) {
    try {
        $sql = "INSERT INTO tags (id_admin, Nom) VALUES (:id_admin, :Nom)";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(":id_admin", $id_admin, PDO::PARAM_INT);
        $stmt->bindParam(":Nom", $tag, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo "Erreur lors de l'ajout des tags : " . $e->getMessage();
        return false;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}



public function modifietags($id, $nom){
    try {
        $sql = "UPDATE tags SET Nom = :Nom  WHERE id_admin = :id_admin";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_admin", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Nom", $nom, PDO::PARAM_STR);
        $stmt->execute();
        header("location: ../views/ajoutertags.php");
    } catch (PDOException $e) {
        return "Erreur lors de Modification de la catégorie :". $e->getMessage();
    }
}



    public function supprimertags( $id_tag) {
        try {
            $sql = "DELETE FROM tags WHERE id_tag = :id_tag ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id_tag', $id_tag);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

            public function afficherTags() {
                try {
                    $sql = "SELECT * FROM tags";
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    return $stmt->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        }
        

        


