<?php
require_once '../database/db.php';
require_once '../classes/user.php';

class Admin extends User{
   private $db ;
   public function __construct($db)
   {
    $this->db= $db;
   }

   public function ajoutercategory($id_admin , $nom){
    try{
        $sql= "INSERT INTO category (id_admin , nom) VALUES (:id_admin , :nom)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(":id_admin" , $id_admin , PDO::PARAM_INT);
        $stmt->bindParam(":nom",$nom, PDO::PARAM_STR);
        $stmt->execute();
         header("Location:../action/addcategory.php");

    }catch (PDOException $e){
        echo "Erreur lors de l'ajout de la catégorie : " .$e->getMessage();
    }
   }

  public function modifiercategory($id_admin , $nom){
    try{
        $sql= "UPDATE catagory SET Nom = :Nom WHERE id_admin = :id_category";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(":id_category" , $id_admin , PDO::PARAM_INT);
        $stmt->bindParam(":Nom" , $nom , PDO::PARAM_STR);
        $stmt->execute();
        header("Location:../action/addcategodry");
    }catch(PDOException $e){
        echo "Erreur lors de Modification de la catégorie :". $e->getMessage();
    }
  }

  public function supprimercategory($id_admin){
    try{
        $sql="DELETE FROM category WHERE id_admin = :id_category";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(":id_admin" , $id_admin , PDO::PARAM_INT);
        $stmt->execute();
    }catch(PDOException $e){
     echo "Erreur lors de la suppression de la catégorie :" . $e->getMessage();
    }  
}




public function ajoutertags($id_admin, $nom) {
    try {
        $sql = "INSERT INTO tags (id_admin, Nom) VALUES (:id_admin, :Nom)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_admin", $id_admin, PDO::PARAM_INT);
        $stmt->bindParam(":Nom", $nom, PDO::PARAM_STR);
        $stmt->execute();
        header("location: ../views/creetag.php");
    } catch (PDOException $e) {
        return "Erreur lors de l'ajout de la catégorie : " . $e->getMessage();
    }
}


public function modifietags($id, $nom){
    try {
        $sql = "UPDATE tags SET Nom = :Nom  WHERE id_admin = :id_admin";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":iid_admin", $id, PDO::PARAM_INT);
        $stmt->bindParam(":Nom", $nom, PDO::PARAM_STR);
        $stmt->execute();
        header("location: ../views/addcategory.php");
    } catch (PDOException $e) {
        return "Erreur lors de Modification de la catégorie :". $e->getMessage();
    }
}


public function supprimertags($id){
    try {
        $sql = "DELETE FROM tags WHERE id_admin= :id_admin";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_admin", $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ../views/addcategory.php");
    } catch (PDOException $e) {
        return "Erreur lors de la suppression de la catégorie : " . $e->getMessage();
    }
}




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





public function refusecours( $id_article){
    try {
        $sql = "UPDATE Cours SET  Statut = 'Refusé' WHERE id_cours = :id_cours";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":id_cours", $id_article, PDO::PARAM_INT);
        $stmt->execute();
        header("location: ");
    } catch (PDOException $e) {
        return "Erreur lors de la Refuse d'Article : ". $e->getMessage();
    }
}

public function supprimerProfil($id) {
    $sql = "DELETE FROM user WHERE id_user = :id_user";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->rowCount(); 
}

public function accepterProfil($id) {
    $sql = "DELETE FROM user WHERE id_user = :id_user";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_user', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->rowCount(); 
}

public function consulterstatistique(){
     
}

}

?>