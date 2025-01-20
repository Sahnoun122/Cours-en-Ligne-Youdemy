<?php

session_start();

require_once '../database/db.php';
require_once '../classes/enseignant.php';
require_once '../classes/cours.php';
require_once '../classes/coursvideo.php';
require_once '../classes/tags.php';
require_once '../classes/category.php';






$db= new DbConnection();
$pdo= $db->getConnection();

$enseignant= new Enseignant($pdo);


$coursvideo= new Coursvideo($pdo);
$tags = new Tags($pdo);
$category = new Category($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id_cours = $_GET['id'];
        $idcours = $enseignant->getid($id_cours);
        if ($idcours) {
            print_r($idcours);
        } else {
             echo "cours non trouvé.";
        }
    }
}
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Article</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 p-6">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-6">Modifier Article</h2>

        <form action="../action/EnseignantActions.php" method="get" enctype="multipart/form-data">
            <input type="hidden" name="id_article" value="<?php echo htmlspecialchars($idcours['id_cours']); ?>">
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 font-semibold">Titre:</label>
                <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($idcours['Titre']); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="contenu" class="block text-gray-700 font-semibold">DESCRIPTION:</label>
                <textarea id="contenu" name="contenu" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"><?php echo htmlspecialchars($idcours['DESCRIPTION']); ?></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">video:</label>
                <input type="file" id="image" name="image" value="<?php echo htmlspecialchars($idcours['video']); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="id_category" class="block text-gray-700 font-semibold">Category ID:</label>
                <input type="number" id="id_category" name="id_category" value="<?php echo htmlspecialchars($idcours['id_category']); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="id_tag" class="block text-gray-700 font-semibold">Tag ID:</label>
                <input type="number" id="id_tag" name="id_tag" value="<?php echo htmlspecialchars($idcours['id_tag']); ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="flex justify-end">
                <input type="submit" value="modifie" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
        </form>
    </div>

</body>
</html>

