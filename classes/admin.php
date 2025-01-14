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




}

?>