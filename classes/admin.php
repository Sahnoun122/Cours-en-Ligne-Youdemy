<?php
require_once '../database/db.php';
require_once '../classes/user.php';

class Admin extends User{
   private $db ;
   public function __construct($db)
   {
    $this->db= $db;
   }

//    public function ajoutercategory($id_admin , $nom){
//     try{
//         $sql= "INSERT INTO Category (id_admin , Nom) VALUES (:id_admin , :Nom)";
//         $stmt= $this->db->prepare($sql);
//         $stmt->bindParam(":id_admin" , $id_admin , PDO::PARAM_INT);
//         $stmt->bindParam(":Nom",$nom, PDO::PARAM_STR);
//         $stmt->execute();
//          header("Location:../views/ajoutercategory");

//     }catch (PDOException $e){
//         echo "Erreur lors de l'ajout de la catégorie : " .$e->getMessage();
//     }
//    }
//   public function modifiercategory($id_admin , $nom){
//     try{
//         $sql= "UPDATE catagory SET Nom = :Nom WHERE id_admin = :id_category";
//         $stmt= $this->db->prepare($sql);
//         $stmt->bindParam(":id_category" , $id_admin , PDO::PARAM_INT);
//         $stmt->bindParam(":Nom" , $nom , PDO::PARAM_STR);
//         $stmt->execute();
//         header("Location:../action/addcategodry");
//     }catch(PDOException $e){
//         echo "Erreur lors de Modification de la catégorie :". $e->getMessage();
//     }
//   }

//   public function supprimercategory($id){
//     try{
//         $sql="DELETE FROM  Category WHERE id_admin = :id_category";
//         $stmt=$this->db->prepare($sql);
//         $stmt->bindParam(":id_category" , $id , PDO::PARAM_INT);
//         $stmt->execute();
//     }catch(PDOException $e){
//      echo "Erreur lors de la suppression de la catégorie :" . $e->getMessage();
//     }  
// }








    // public function accepteuser($id_user){
    //     try {
    //         $sql = "UPDATE user SET  Statut = 'Accepté' WHERE id_user = :id_user";
    //         $stmt = $this->db->prepare($sql);
    //         $stmt->bindParam(":id_cours", $id_user, PDO::PARAM_INT);
    //         $stmt->execute();
    //         header("location: ");
    //     } catch (PDOException $e) {
    //         return "Erreur lors de la confirmation utilisateurs : ". $e->getMessage();
    //     }
    // }

public function acceptercours($id_cours){
    try {
        $sql = "UPDATE Cours SET  Statut = 'Accepté' WHERE id_cours = :id_cours";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_cours", $id_cours, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ");
    } catch (PDOException $e) {
        return "Erreur lors de la confirmation d'Article : ". $e->getMessage();
    }
}


public function refusecours( $id_cours){
    try {
        $sql = "UPDATE Cours SET  Statut = 'Refusé' WHERE id_cours = :id_cours";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_cours", $id_cours, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ");
    } catch (PDOException $e) {
        return "Erreur lors de la Refuse d'Article : ". $e->getMessage();
    }
}

    
public function voirprofile() {
    $sql = "SELECT * FROM user WHERE ROLE IN ('etudiant', 'enseignant')";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


public function accepterProfil($id) {
    $sql = "UPDATE user SET Statut = 'Accepté' WHERE id_user = :id_user";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->rowCount();
}



public function supprimerProfil($id) {
    $sql = "DELETE FROM user WHERE id_user = :id_user";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->rowCount();
}

public function getTotalcours() {
    $sql = "SELECT COUNT(*) AS total_courses FROM Cours;";
    $stmt = $this->db->prepare($sql);
    
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Affiche des informations de débogage
        var_dump($stmt->errorInfo());
        return false;
    }
}


public function getTopTeachers() {
    $sql = "SELECT 
                user.Nom AS teacher_name, 

                user.Prenom AS teacher_surname, 
                COUNT(Cours.id_cours) AS number_of_courses 
            FROM 
                Cours 
            JOIN 
                user ON Cours.id_enseignant = user.id_user 
            WHERE 
                user.ROLE = 'enseignant' 
            GROUP BY 
                user.id_user, user.Nom, user.Prenom 
            ORDER BY 
                number_of_courses DESC 
            LIMIT 3;";

    $stmt = $this->db->prepare($sql);
    
    if ($stmt->execute()) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        var_dump($stmt->errorInfo());
        return false;
    }
}


    public function getCourpopulaire() {
        $sql = "SELECT 
                    Cours.Titre AS course_title, 
                    COUNT(inscription.id_cours) AS number_of_students 
                FROM 
                    inscription 
                JOIN 
                    Cours ON inscription.id_cours = Cours.id_cours 
                GROUP BY 
                    Cours.Titre 
                ORDER BY 
                    number_of_students DESC 
                LIMIT 1;";
        $stmt = $this->db->prepare($sql);
        
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            var_dump($stmt->errorInfo()); 
            return false;
        }
    
}



}




?>