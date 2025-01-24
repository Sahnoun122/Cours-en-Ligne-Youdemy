<?php 
 require_once '../database/db.php';
 require_once '../classes/user.php';

 class Etudiant extends User{
      
    private $db ;
    public function __construct($db)
    {
     $this->db= $db;
    }
 
    public function searchCourses($searchTerm) {
        try {
            $sql = "SELECT 
            Cours.id_cours,
            Cours.Titre,
            Cours.DESCRIPTION,
            Cours.video,
            Category.Nom AS NomCategorie,
            tags.Nom AS NomTag
            FROM 
                Cours
            INNER JOIN 
                Category ON Cours.id_category = Category.id_category
            INNER JOIN 
                tags ON Cours.id_tag = tags.id_tag 
            WHERE (Titre LIKE :searchTerm OR DESCRIPTION LIKE :searchTerm)
            AND Statut = 'Accepté'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':searchTerm' => "%$searchTerm%"]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return [];
        }
    }
    
    public function Inscription($id_user, $id_cours) {
        try {
            $sql = "INSERT INTO inscription (id_user, id_cours) 
                    VALUES (:id_user, :id_cours)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_user", $id_user, PDO::PARAM_INT);
            $stmt->bindParam(":id_cours", $id_cours, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    
    public function afficherinscription() {
        try {
            $sql = "SELECT 
                Cours.Titre,
                inscription.dateInsrire,
                user.Nom
            FROM 
                inscription 
            JOIN 
                Cours
            ON 
                inscription.id_cours = Cours.id_cours
            JOIN 
                user 
            ON 
                inscription.id_user= user.id_user
            WHERE 
                user.ROLE = 'etudiant'";
         
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
             
            if($stmt->rowCount() > 0) {
                $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultat;
            } else {
                return false;
            }
             
        } catch(Exception $e) {
            echo "error: " . $e->getMessage();
        }
    } 
 }
 
?>