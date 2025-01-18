<?php 
 require_once '../database/db.php';
 require_once '../classes/user.php';

 class Etudiant extends User{
      
    private $db ;
    public function __construct($db)
    {
     $this->db= $db;
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
     

 }
 
?>