<?php
session_start();

require_once '../database/db.php';
require_once '../classes/admin.php';
require_once '../classes/category.php';


session_start();

// if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     header("Location: connecter.php");
//     exit;
// }





$db= new DbConnection();
$pdo = $db->getConnection();

$admin = new Admin($pdo);
$category = new Category($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Nom'])) {

    $id_admin =$_SESSION['id_user'];
    $nom = $_POST['Nom'];
   
    $admin->ajoutercategory($id_admin , $nom);

    header("Location:../views/ajoutercategory.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $category = $_POST['delete'];
    $id = $_SESSION['id_user'];
    
   $admin->supprimercategory($id);
   header("Location:../views/ajoutercategory.php");
   exit;
}