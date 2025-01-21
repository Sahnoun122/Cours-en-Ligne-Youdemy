<?php

session_start();

require_once '../database/db.php';
require_once '../classes/enseignant.php';
require_once '../classes/tags.php';
require_once '../classes/category.php';
require_once '../classes/coursvideo.php';
require_once '../classes/cours.php';


$db= new DbConnection();
$pdo= $db->getConnection();

$enseignant= new Enseignant($pdo);

$tags= new Tags($pdo);
 
$category = new Category($pdo);

$coursvideo= new Coursvideo($pdo );


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Titre'])) {
    $id_enseignant = $_SESSION['id_user'];
    $titre = $_POST['Titre'];
    $description = $_POST['DESCRIPTION'];
    $id_category = $_POST['id_category'];
    $id_tag = $_POST['id_tag'];

    $video = pathinfo($_FILES['video_up']['tmp_name'], PATHINFO_FILENAME);
    $file_extension = pathinfo($_FILES['video_up']['name'], PATHINFO_EXTENSION);
    $new_vid_name =  $video .'_'.date("ymd_His").'.'. $file_extension;
    
    $target_direct = "../assets/video/";
    $target_path = $target_direct . $new_vid_name;
   
     
    if (!move_uploaded_file($_FILES['video_up']['tmp_name'], $target_path)) {
        die('Erreur lors du téléchargement du fichier.');
    }
    $coursvideo= new Coursvideo($pdo );
    $coursvideo->ajouterCours($id_enseignant, $titre, $description, $target_path, $id_category, $id_tag);
    header("Location:../views/ajoutercours.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    echo $_POST['delete'];
    $cour= intval($_POST['delete']);
    $coursvideo->supprimeCours($cour);
    header("Location:../views/ajoutercours.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_cours'], $_GET['Titre'], $_GET['DESCRIPTION'], $_GET['video'], $_GET['id_category'], $_GET['id_tag'])) {
    $id_cours = (int)$_GET['id_cours'];
    $titre = $_GET['Titre'];
    $description = $_GET['DESCRIPTION'];
    $video = $_GET['video'];
    $id_category = (int)$_GET['id_category'];
    $id_tag = (int)$_GET['id_tag'];
    if ($coursvideo->modifierCours($id_cours, $titre, $description, $video, $id_category, $id_tag)) {
        header("Location:../views/ajoutercours.php");
        exit;
    } else {
        echo "Error updating cours.";
    }
} else {
    echo "Invalid request.";
}


