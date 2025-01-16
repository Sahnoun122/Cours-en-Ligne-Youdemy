<?php
session_start();

require_once '../database/db.php';
require_once '../classes/admin.php';
require_once '../classes/category.php';
require_once '../classes/tags.php';



session_start();

// if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     header("Location: connecter.php");
//     exit;
// }

$db= new DbConnection();
$pdo = $db->getConnection();

$admin = new Admin($pdo);
$category = new Category($pdo);

$tags = new Tags($pdo);


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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Nom'])) {
        $nom = $_POST['Nom'];
        $id_admin = $_SESSION['id_user'];
        $admin->ajoutertags($id_admin, $nom);

        header("Location:../views/ajoutertags.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_tag = $_POST['delete'];

    if ($admin->supprimertags( $id_tag)) {
        header("Location:../views/ajoutertags.php");
        exit;
    } else {
        echo "Failed to delete the tag.";
    }
}


$tags_ = $tags->afficherTags();
