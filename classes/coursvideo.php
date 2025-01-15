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
            Cours.Titre,
            Cours.DESCRIPTION,
            Cours.video,
            Cours.pdf,
            Cours.Statut,
            Cours.DateCréation,
            Cours.DateModification,
            Category.Nom AS NomCategorie,
            tags.Nom AS NomTag
            FROM 
                Cours
            INNER JOIN 
                Category ON Cours.id_category = Category.id_category
            INNER JOIN 
                tags ON Cours.id_tag = tags.id_tag;
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

