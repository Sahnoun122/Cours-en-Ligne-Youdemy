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
   
    
    public function getIdcours($id_cours) {
        try {
            $sql = "SELECT * FROM Cours WHERE id_cours = :id_cours";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":id_cours", $id_cours, PDO::PARAM_INT);
            $stmt->execute();
            $article = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$article) {
                echo "Article non trouvé.";
            }
            
            return $article;
        } catch (PDOException $e) {
            return "Erreur lors de la récupération de l'article : " . $e->getMessage();
        }
    }
    

    function affichercoursetudiants(){
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


}

