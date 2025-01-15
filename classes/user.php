<?php 

require_once '../database/db.php';

class User{
    
    private $id_user;
    private $nom;
    private $prenom;
    private $email;
    private $profile;
    private $Motdepasse;
    private PDO $role;

    private $db;

public function __construct($db)
{
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



 public function getData(){
    $id_user = $_SESSION['id_user'];
    $query ="SELECT * FROM user WHERE id_user = :id_user";
    $stmt= $this->db->prepare($query);
    $stmt->execute([':id_user'=> $id_user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
 }
  

}


?>