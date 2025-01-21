
<?php

    include_once '../database/db.php';

    class Category{
        private  $id_category;
        private  $nom;
    
        private $db;

        public function __construct($db)
        {
            $this->db=$db;
        }

        public function getId(){
            return $this->id_category;
        }
        public function getNom(){
            return $this->nom;
        }
     
      
        public function setNom($nom){
            $this->nom = $nom;
        }
    
        
   public function ajoutercategory($id_admin , $nom){
    try{
        $sql= "INSERT INTO Category (id_admin , Nom) VALUES (:id_admin , :Nom)";
        $stmt= $this->db->prepare($sql);
        $stmt->bindParam(":id_admin" , $id_admin , PDO::PARAM_INT);
        $stmt->bindParam(":Nom",$nom, PDO::PARAM_STR);
        $stmt->execute();
         header("Location:../views/ajoutercategory");

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

  public function supprimercategory($id){
    try{
        $sql="DELETE FROM  Category WHERE id_admin = :id_category";
        $stmt=$this->db->prepare($sql);
        $stmt->bindParam(":id_category" , $id , PDO::PARAM_INT);
        $stmt->execute();
    }catch(PDOException $e){
     echo "Erreur lors de la suppression de la catégorie :" . $e->getMessage();
    }  
}

        public function affichercategory(){
            try{
                 $sql= "SELECT * FROM Category ";
                 $stmt = $this->db->prepare($sql);
                 $stmt->execute();
                 return $stmt->fetchALL(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                echo "Errore" .$e->getMessage();
            }
           }

           
     

    }

