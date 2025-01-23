<?php
require_once '../classes/cours.php';
class Coursvideo extends Cours{
       
    private $db;
     public function __construct($db)
     {
        $this->db= $db ;
     }


    public function afficherCours(){
    try{
            $sql="SELECT 
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
                
                ;
        ";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();

        if($stmt->rowcount()>0){
            $result= $stmt->fetchAll();
            return $result;
        }else{
            return "Aucun cours trouvé" ;
        }

    }catch(PDOException $e){
            echo "Erreur lors de la récupération des cours : " .$e->getMessage();
        }
    }
   
    
    
    
    public function afficherCoursensignats($id_enseignant){
        try{
                $sql="SELECT 
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
                    WHERE Cours.id_enseignant = :id_enseignant
                    ;
            ";
            $stmt= $this->db->prepare($sql);
            $stmt->bindParam(':id_enseignant', $id_enseignant , PDO::PARAM_INT);

            $stmt->execute();
            $result= $stmt->fetchAll();

           
                return $result;
           
    
        }catch(PDOException $e){
                echo "Erreur lors de la récupération des cours : " .$e->getMessage();
            }
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



 

   public function affichercoursetudiants(){
        try{
            $sql="SELECT 
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
                WHERE Statut = 'Accepté'
                ;
        ";
        $stmt= $this->db->prepare($sql);
        $stmt->execute();
        if($stmt->rowcount()>0){
            $result= $stmt->fetchAll();
            return $result;
        }else{
            return "Aucun cours trouvé" ;
        }

    }catch(PDOException $e){
            echo "Erreur lors de la récupération des cours : " .$e->getMessage();
        }
    }

    
    public function afficherstatu() {
        try {
            $query = "SELECT Titre, Statut, DateCréation
                      FROM Cours
                      ORDER BY DateCréation DESC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            return "Erreur lors de la Récupération des Articles: " . $e->getMessage();
        }
    }



    public function getdetails($id_cours) {
        try {
            $query = "SELECT user.Nom, category.Nom, cours.*, GROUP_CONCAT(tags.Nom) AS Tags
                      FROM Cours
                      JOIN user ON user.id_user = Cours.id_enseignant
                      JOIN category ON category.id_category = Cours.id_category
                      LEFT JOIN courstag ON courstag.id_cours = cours.id_cours
                      LEFT JOIN tags ON tags.id_tag = courstag.id_tag
                      WHERE cours.id_cours = :id_cours
                      GROUP BY cours.id_cours";
    
            $stmt = $this->db->prepare($query);
            $stmt->execute([':id_cours' => $id_cours]);
    
            $cours = $stmt->fetch(PDO::FETCH_ASSOC);
    
          
            return $cours;
        } catch (PDOException $e) {
            error_log($e->getMessage());
            return "Failed to fetch course details.";
        }
    }
 
}

