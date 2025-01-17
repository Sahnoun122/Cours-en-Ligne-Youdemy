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
        $user= $auth->login($user->getEmail(), $auth-> getMotdepasse());

        $_SESSION ['id_user'] = $user['id_user'];
        $_SESSION['Email'] = $user['Email'];
        $_SESSION['Nom']= $user['Nom'];
        $_SESSION['ROLE']= $user['ROLE'];

        if($user['ROLE']=== 'admin'){
            header('Location:dashbordadmin.php');
        }else if($user ['ROLE'] === 'etudiant'){
            header('Location:dashbordetudiant.php');
        }else if ($user['ROLE'] === 'enseignant'){
            header('Location:dasbordenseignant.php');
        }
        exit();
    }catch (Exception $e){
        echo "errour " . $e->getMessage();
    }
   }