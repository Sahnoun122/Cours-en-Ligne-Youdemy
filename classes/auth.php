<?php 
 require_once '../database/db.php';

 class Auth{
   
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
      
    public function login($email , $Motdepasse){
        try{
            $sql= "SELECT id_user , Email , Motdepasse , ROLE , profile  , Nom FROM user WHERE Email = :Email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':Email' => $email]);

            if($stmt -> rowCount()>0){
           $user= $stmt ->fetch(PDO::FETCH_ASSOC);
           if(password_verify($Motdepasse, $user['Motdepasse'])){
            return[
                'i_user'=>$user['id_user'],
                'Email'=>$user['Email'],
                'profile'=>$user['profile'],
                'ROLE'=>$user['ROLE'],
                'Nom'=>$user['Nom'],
            ];

           }else{
            throw new Exception('mot de passe Incorrect !');
           }

            }  
            
            

        }catch (Exception $e){
           throw $e;
        }
    }


 }




?>