<?php 
 require_once '../database/db.php';
 require_once '../classes/user.php';

 class Etudiant extends User{
      
    private $db ;
    public function __construct($db)
    {
     $this->db= $db;
    }


    
    private $table_name = "Cours";
 
    public function searchCourses($query) {
        $query = "%" . $query . "%";
        $sql = "SELECT Titre, DESCRIPTION FROM Cours  WHERE Titre LIKE :query OR DESCRIPTION LIKE :query";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":query", $query);
        $stmt->execute();

        return $stmt;
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