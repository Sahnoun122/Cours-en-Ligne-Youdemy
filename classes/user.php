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

 public function register() {
    try {
        $toutsrole = ['admin', 'etudiant', 'enseignant'];
        if (!in_array($this->role, $toutsrole)) {
            throw new Exception('Role invalide.');
        }

        $this->db->beginTransaction();

        $sqluser = "INSERT INTO user (Nom, Prenom, Email, Motdepasse, ROLE, profile) 
                   VALUES (:Nom, :Prenom, :Email, :Motdepasse, :ROLE, :profile)";

        $stmt = $this->db->prepare($sqluser);
        $stmt->bindParam(":Nom", $this->nom);
        $stmt->bindParam(":Prenom", $this->prenom);
        $stmt->bindParam(":Email", $this->email);
        $stmt->bindParam(":Motdepasse", $this->Motdepasse); 
        $stmt->bindParam(":ROLE", $this->role);
        $stmt->bindParam(":profile", $this->profile);

        $stmt->execute();
        $userid = $this->db->lastInsertId();
        $this->db->commit();

        return $userid;
    } catch (Exception $e) {
        $this->db->rollback();
        throw new Exception("Enregistrement incorrect: " . $e->getMessage());
    }
}


public function login() {
    try {
       
        
        $sql = "SELECT * FROM user WHERE Email = :Email AND Statut = 'Accepté'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':Email' => $this->email]);
        
        echo "<p>Rows found in database: " . $stmt->rowCount() . "</p>";

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $verifyResult = password_verify($this->Motdepasse, $user['Motdepasse']);            
            if ($verifyResult) {
                
                $this->id_user = $user['id_user'];
                $this->prenom = $user['Prenom'];
                $this->nom = $user['Nom'];
                $this->email = $user['Email'];
                $this->role = $user['ROLE'];
                $this->profile = $user['profile'];
               
                return true;
            } else {  
                throw new Exception('Mot de passe incorrect !');
            }
        } else {
           
            throw new Exception('Email non trouvé !');
        }
    } catch (Exception $e) {
        echo "<p style='color: red;'>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "</div>";
        throw $e;
    }
}


 public function getData(){
    $id_user = $_SESSION['id_user'];
    $query ="SELECT * FROM user WHERE id_user = :id_user ";
    $stmt= $this->db->prepare($query);
    $stmt->execute([':id_user'=> $id_user]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
 }

}


?>