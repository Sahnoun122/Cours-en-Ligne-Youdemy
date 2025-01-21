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
        echo "<div style='background-color: #f0f0f0; padding: 20px; margin: 20px; font-family: monospace;'>";
        echo "<h3>Debug Information:</h3>";
        
        // Connection check
        echo "<p>Database Connection: " . ($this->db ? "✅ Connected" : "❌ Not Connected") . "</p>";
        echo "<p>Login attempt for email: " . htmlspecialchars($this->email) . "</p>";
        
        $sql = "SELECT * FROM user WHERE Email = :Email AND Statut = 'Accepté'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':Email' => $this->email]);
        
        echo "<p>Rows found in database: " . $stmt->rowCount() . "</p>";

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            echo "<p>Found user with ID: " . $user['id_user'] . "</p>";
            
            // Password verification debug
            echo "<h4>Password Verification Details:</h4>";
            echo "<p>Submitted password length: " . strlen($this->Motdepasse) . "</p>";
            echo "<p>Stored hash length: " . strlen($user['Motdepasse']) . "</p>";
            echo "<p>Hash format: " . (strpos($user['Motdepasse'], '$2y$') === 0 ? "✅ Valid bcrypt" : "❌ Invalid format") . "</p>";
            
            // For testing - create a new hash with the submitted password
            $newHash = password_hash($this->Motdepasse, PASSWORD_DEFAULT);
            echo "<p>New hash generated from submitted password: " . substr($newHash, 0, 10) . "...</p>";
            echo "<p>Stored hash in database: " . substr($user['Motdepasse'], 0, 10) . "...</p>";
            
            // Verify password
            $verifyResult = password_verify($this->Motdepasse, $user['Motdepasse']);
            echo "<p>Password verification result: " . ($verifyResult ? "✅ Success" : "❌ Failed") . "</p>";
            
            if ($verifyResult) {
                echo "<p style='color: green;'>✅ Login successful!</p>";
                
                $this->id_user = $user['id_user'];
                $this->prenom = $user['Prenom'];
                $this->nom = $user['Nom'];
                $this->email = $user['Email'];
                $this->role = $user['ROLE'];
                $this->profile = $user['profile'];
                
                echo "</div>";
                return true;
            } else {
                echo "<p style='color: red;'>❌ Password verification failed</p>";
                // Safe debug info - only show first few characters
                echo "<p>First few chars of submitted password: '" . htmlspecialchars(substr($this->Motdepasse, 0, 3)) . "...'</p>";
                echo "</div>";
                
                throw new Exception('Mot de passe incorrect !');
            }
        } else {
            echo "<p style='color: red;'>❌ No user found with this email</p>";
            echo "</div>";
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