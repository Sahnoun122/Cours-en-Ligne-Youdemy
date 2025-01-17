<?php 

require_once '../database/db.php';

 class User{
    
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $profile;
    private $Motdepasse;
    private $role;

    private $db;

public function __construct($db , $nom , $prenom ,$email,$Motdepasse ,$profile,$role)
{
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->email = $email;
    $this->Motdepasse = $Motdepasse;
    $this->role = $role;
    $this->profile = $profile;
    $this->db= $db;
}




public function getIduser(){
    return $this->id_user;
}

public function getNom(){
    return $this->nom;
}
public function getPrenom(){
    return $this->prenom;
}
public function getEmail(){
    return $this->email;
}
 public function getProfile(){
   return  $this->profile;
 }

 public function getMotdepasse(){
    return $this->Motdepasse;
 }

 public function getRole(){
    return $this->role;
 }


 
 public function setNom($nom){
     $this->nom =$nom;
 }
 public function setPrenom($prenom){
    $this->prenom =$prenom;
 }
 public function setEmail($email){
    $this->email= $email;
 }
 public function setProfile($profile){
    $this->profile = $profile;
 }

 public function setMotdepasse($Motdepasse){
    $this->Motdepasse= $Motdepasse;
 }
 public function setRole($role){
    $this->role= $role;
 }

     
 public function register( $nom,$prenom,$email,$Motdepasse,$role , $profile){

    try{
    $toutsrole=['admin', 'etudiant' ,'enseignant'];
    if(!in_array($role, $toutsrole)){
        throw new Exception('invalide role .');
    }
    $this->db->beginTransaction();

     $Motdepasse = password_hash($Motdepasse, PASSWORD_BCRYPT);
    $sqluser = "INSERT INTO user (Nom , Prenom , Email , Motdepasse , ROLE , profile  ) VALUES (:Nom , :Prenom , :Email , :Motdepasse , :ROLE  , :profile)  ";
    
    $stmt = $this->db->prepare($sqluser);
    $stmt->bindParam(":Nom", $nom, PDO::PARAM_STR);
    $stmt->bindParam(":Prenom", $prenom, PDO::PARAM_STR);
    $stmt->bindParam(":Email", $email, PDO::PARAM_STR);
    $stmt->bindParam(":Motdepasse", $Motdepasse, PDO::PARAM_STR);
    $stmt->bindParam(":ROLE", $role, PDO::PARAM_STR);
    $stmt->bindParam(":profile",  $profile, PDO::PARAM_STR);

    $stmt->execute();


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

        $this->id_user =  $user['id_user'];
        $this->prenom =  $user['Prenom'];
        $this->nom =  $user['Nom'];
        $this->email =  $user['email'];
        $this->role =  $user['ROLE'];
        $this->profile =  $user['profile'];

        return $this;
       }else{
        throw new Exception('mot de passe Incorrect !');
       }
        }  
        
    }catch (Exception $e){
       throw $e;
    }
}



 public function getData(){
    $id_user = $_SESSION['id_user'];
    $query ="SELECT * FROM user WHERE id_user = :id_user";
    $stmt= $this->db->prepare($query);
    $stmt->execute([':id_user'=> $id_user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
 }


 public function supprimerData(){

 }

 public function activeData(){

 }


}


?>