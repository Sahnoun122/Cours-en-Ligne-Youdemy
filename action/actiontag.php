<?php
session_start();

require_once '../database/db.php';
require_once '../classes/admin.php';
require_once '../classes/category.php';
require_once '../classes/tags.php';




$db= new DbConnection();
$pdo = $db->getConnection();

$admin = new Admin($pdo);
$category = new Category($pdo);

$tags = new Tags($pdo);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['Nom'])) {
        $id_admin = $_SESSION['id_user'];
        $tagsArray = ['Nom[]'];
        $tags_=  $admin->ajoutertags($id_admin,$tagsArray);  
        header("Location:../views/ajoutertags.php");

    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id_tag = $_POST['delete'];
    $id = $_SESSION['id_user'];

    if ($admin->supprimertags( $id_tag)) {
        header("Location:../views/ajoutertags.php");
        exit;
    } else {
        echo "Failed to delete the tag.";
    }
}
 
$tags_ = $tags->afficherTags();