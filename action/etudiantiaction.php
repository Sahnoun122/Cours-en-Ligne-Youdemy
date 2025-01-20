<?php
session_start();
require_once '../classes/etudiant.php';
require_once '../database/db.php';

$db= new DbConnection();
$pdo = $db->getConnection();


$etudiant = new Etudiant($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscrire'])) {
    $id_user = $_SESSION['id_user'];
    $id_cours = $_POST['id_cours'];

    if ($etudiant->Inscription($id_user, $id_cours)) {
        header("Location: ../views/dashbordetudiant.php");
        exit;
    } else {
        echo "Error in enrollment";
    }


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $query = $_POST['search'];
        $stmt = $etudiant->searchCourses($query);
        header("Location:../views/dashbordvisiteur.php");
    
        echo "<div id='search-results'>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<h3>" . $row['Titre'] . "</h3><p>" . $row['DESCRIPTION'] . "</p>";
        }
        echo "</div>";
    }
    
}





