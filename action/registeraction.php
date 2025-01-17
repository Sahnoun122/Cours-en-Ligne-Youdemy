
<?php
session_start();

require_once '../database/db.php';
require_once '../classes/user.php';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$db = new DbConnection();
$pdo = $db->getConnection();
$auth = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Jeton CSRF invalide');
    }

    $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $Motdepasse = htmlspecialchars($_POST['Motdepasse'], ENT_QUOTES, 'UTF-8');
    $role = htmlspecialchars($_POST['role'], ENT_QUOTES, 'UTF-8');

    if (empty($nom) || empty($prenom) || empty($email) || empty($Motdepasse)) {
        die('Tous les champs sont obligatoires.');
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Format d\'email invalide.');
    }
    $profile = pathinfo($_FILES['PROFILE']['tmp_name'], PATHINFO_FILENAME);
    $file_extension = pathinfo($_FILES['PROFILE']['name'], PATHINFO_EXTENSION);
    $new_image_name = $profile .'_'.date("ymd_His").'.'. $file_extension;

    $target_direct = "C:/laragon/www/Youdemy/assets/uploade/";
    $target_path = $target_direct . $new_image_name;

    if (!move_uploaded_file($_FILES['PROFILE']['tmp_name'], $target_path)) {
        die('Erreur lors du téléchargement du fichier.');
    }

    try {
        $userid = $auth->register($nom, $prenom, $email, $Motdepasse, $role, $new_image_name);
        header('Location:../views/connecter.php');
        exit();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

?>