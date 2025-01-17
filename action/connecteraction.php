<?php
require_once '../database/db.php';
   require_once '../classes/user.php';
   session_start();

  $db = new DbConnection();
  $pdo = $db->getConnection();

  
  if($_SERVER['REQUEST_METHOD' ] === 'POST'){
      $email = $_POST['Email'];
      $Motdepasse = $_POST['Motdepasse'];
      
      try{
        $auth = new User($pdo , null , null ,$email,$Motdepasse ,null,null);
        $user= $auth->login($auth->getEmail(), $auth-> getMotdepasse());

        $_SESSION ['id_user'] = $user->getIduser();
        $_SESSION['Email'] = $user->getEmail();
        $_SESSION['Nom']= $user->getNom();
        $_SESSION['ROLE']= $user->getRole();

        if($user->getRole()=== 'admin'){
            header('Location:../views/dashbordadmin.php');
        }else if($user->getRole()=== 'etudiant'){
            header('Location:../views/dashbordetudiant.php');
        }else if ($user->getRole() === 'enseignant'){
            header('Location:../views/dasbordenseignant.php');
        }
        exit();
    }catch (Exception $e){
        echo "errour " . $e->getMessage();
    }
   }