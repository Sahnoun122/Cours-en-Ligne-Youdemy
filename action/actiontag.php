<?php
session_start();

require_once '../database/db.php';
require_once '../classes/admin.php';
require_once '../classes/category.php';
require_once '../classes/tags.php';

$db = new DbConnection();
$pdo = $db->getConnection();

$admin = new Admin($pdo);
$category = new Category($pdo);
// $tags = new Tags($pdo);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_admin = $_SESSION['id_user'];
    $tags = $_POST['Nom'];
    echo '<pre>';
    var_dump($tags);
    echo '</pre>';
    print_r($tags);

    if (is_array($tags) || is_object($tags)){
        foreach ($tags as $tag) {
            print_r($tag);
            $tags_c = $admin-> ajoutertags($id_admin, $tag);
        }
        if ($tags_c) {
            header("Location: ../views/ajoutertags.php");
            exit;
        } else {
            echo "Failed to add tags";
        }
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
 
