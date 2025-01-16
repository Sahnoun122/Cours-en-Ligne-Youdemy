<?php

session_start();

require_once '../database/db.php';
require_once '../classes/enseignant.php';
require_once '../classes/tags.php';
require_once '../classes/category.php';
require_once '../classes/coursvideo.php';




if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Titre'])) {
    $id_enseignant = $_SESSION['id_user'];
    $titre = $_POST['Titre'];
    $description = $_POST['DESCRIPTION'];
    $video = $_POST['video'];
    $pdf = $_POST['pdf'];
    $id_category = $_POST['id_category'];
    $id_tag = $_POST['id_tag'];

    $enseignant->ajouterCours($id_enseignant, $titre, $description, $video, $pdf, $id_category, $id_tag);
    header("Location: ../views/ajoutercours");
    exit;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    echo $_POST['delete'];
    $cours= intval($_POST['delete']);
    $enseignant->supprimeCours($cours);
    header("Location: ../views/ajoutercours");
    exit;
}

