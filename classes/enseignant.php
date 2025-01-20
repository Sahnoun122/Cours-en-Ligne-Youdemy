<?php 
 require_once '../database/db.php';
 require_once '../classes/user.php';

 class Enseignant extends User{
       
    private $db;
     public function __construct($db)
     {
        $this->db= $db ;
     }


    
    public function ajouterCours($id_enseignant, $titre, $description, $video, $id_category, $id_tag) {
        try {
            $sql = 'INSERT INTO Cours (id_enseignant, Titre, DESCRIPTION, video, id_category, id_tag) VALUES (:id_enseignant, :Titre, :DESCRIPTION, :video, :id_category, :id_tag)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":Titre", $titre , PDO::PARAM_STR);
            $stmt->bindParam(":DESCRIPTION", $description , PDO::PARAM_STR);
            $stmt->bindParam(":video", $video);
            $stmt->bindParam(":id_tag", $id_tag, PDO::PARAM_INT);
            $stmt->bindParam(":id_enseignant", $id_enseignant, PDO::PARAM_INT);
            $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
    
            $stmt->execute();
    
            echo "Cours ajouté avec succès !";
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout de cours: " . $e->getMessage();
        }
    }
    

    public function modifierCours($id_cours, $titre,$description,$video, $id_category, $id_tag) {
        try {
        $sql = "UPDATE Cours SET Titre = :Titre, DESCRIPTION= :DESCRIPTION ,video=:video ,id_category = :id_category, id_tag = :id_tag WHERE id_cours = :id_cours";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":Titre", $titre, PDO::PARAM_STR);
        $stmt->bindParam(":video", $video, PDO::PARAM_STR);
        $stmt->bindParam(":DESCRIPTION", $description, PDO::PARAM_STR);
        $stmt->bindParam(":id_category", $id_category, PDO::PARAM_INT);
        $stmt->bindParam(":id_tag", $id_tag, PDO::PARAM_INT);
        $stmt->bindParam(":id_cours", $id_cours, PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else {
            return false;
        }
        
        } catch (PDOException $e) {
            return "Erreur lors de la modification de cours: " . $e->getMessage();
        }
    }
    

    public function supprimeCours($id) {
        try {
            $sql = "DELETE FROM Cours WHERE id_cours = :id_cours";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_cours", $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            return "Erreur lors de la suppression de cours : " . $e->getMessage();
        }
    }



    public function voirinscription() {
        $sql = "SELECT * FROM user WHERE ROLE = 'etudiant' ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getid($id_cours) {
        try {
            $sql = "SELECT * FROM Cours WHERE id_cours = :id_cours";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_cours", $id_cours, PDO::PARAM_INT);
            $stmt->execute();
            $id_cours = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$id_cours) {
                echo "Article non trouvé.";
            }
            
            return $id_cours;
        } catch (PDOException $e) {
            return "Erreur lors de la récupération de l'article : " . $e->getMessage();
        }
    }

 }

?>