<?php 
 require_once '../database/db.php';

 class auth{
   
    private $db;

    public function __construct($db)
    {
         $this->db =$db ;
    }
       
    public function register($nom,$prenom,$email,$Motdepasse,$role , $profile){

        try{
        $toutsrole=['admin', 'etudiant' ,'enseignant'];
        if(!in_array($role, $toutsrole)){
            throw new Exception('invalide role .');
        }
        $this->db->beginTransaction();

         $Motdepasse = password_hash($Motdepasse, PASSWORD_BCRYPT);
        $sqluser = "INSERT INTO user (Nom , Prenom , Email , Motdepasse , ROLE , profile  ) VALUES (:Nom , :Prenom , :Email , :Motdepasse , :ROLE  , :profile)  ";
        $stmt = $this->db->prepare($sqluser);
        $stmt->execute([
                 ':Nom'=> $nom,
                 ':Prenom'=> $prenom,
                 ':Email'=> $email,
                 ':Motdepasse' => $Motdepasse,
                 ':ROLE'=> $role,
                 ':profile'=> $profile
        ]);
        $userid= $this->db->lastInsertId();
        
       $this->db->commit();
       return $userid;
        }catch(Exception $e){
            $this->db->rollback();
            throw new Exception("incorrect registration .");
        }
    }
      


 }




?>