<?php 
 require_once '../database/db.php';
 require_once '../classes/user.php';

 class Etudiant extends User{
      
    private $db ;
    public function __construct($db)
    {
     $this->db= $db;
    }

    public function Inscription( $id_user, $dateInscrire) {
        $sql = "INSERT INTO inscription (id_user, `status`, dateInsrire) 
                VALUES (:id_user, :status, :dateInsrire)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':id_user' => $id_user,
            ':status' => 'Soumiss',
            ':resDate' => $dateInscrire
        ]);
        return $stmt->rowCount() > 0;
    }

 
    
    



 }
 
?>