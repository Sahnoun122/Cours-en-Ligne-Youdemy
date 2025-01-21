<?php
require_once '../database/db.php';
require_once '../classes/user.php';
session_start();

$db = new DbConnection();
$pdo = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['Email'];
    $Motdepasse = $_POST['Motdepasse'];

    try {
        $auth = new User($pdo, null, null, $email, $Motdepasse, null, null);
        $auth->login();

        $_SESSION['id_user'] = $auth->getIduser();
        $_SESSION['Email'] = $auth->getEmail();
        $_SESSION['Nom'] = $auth->getNom();
        $_SESSION['ROLE'] = $auth->getRole();

        if ($auth->getRole() === 'admin') {
            header('Location:../views/dashbordadmin.php');
        } elseif ($auth->getRole() === 'etudiant') {
            header('Location:../views/dashbordetudiant.php');
        } elseif ($auth->getRole() === 'enseignant') {
            header('Location:../views/dasbordenseignant.php');
        }
        exit();
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>
