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

$category = new Category($pdo);

$tags = new Tags($pdo);

$coursvideo= new Coursvideo($pdo);
$tags = new Tags($pdo);


if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $id_cours = $_GET['id'];
        $idcours = $enseignant->getid($id_cours);
        if ($idcours) {
            // print_r($idcours);
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

        <form action="../action/EnseignantActions.php" method="GET" enctype="multipart/form-data">
            <input type="hidden" name="id_cours"
             value="<?php echo htmlspecialchars($idcours['id_cours']); ?>">
            <div class="mb-4">
                <label for="titre" class="block text-gray-700 font-semibold">Titre:</label>
                <input type="text" id="titre" name="Titre"
                 value="<?php echo $idcours['Titre']; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="contenu" class="block text-gray-700 font-semibold">DESCRIPTION:</label>
                <textarea id="contenu" name="DESCRIPTION" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
              <?php echo $idcours['DESCRIPTION']; ?></textarea>
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-semibold">video:</label>
                <input type="file" id="image" name="video" 
                value="<?php echo $idcours['video']; ?>" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
            </div>
            <div class="mb-4">
                <label for="id_category" class="block text-gray-700 font-semibold">Category ID:</label>
                <select id="category" name="id_category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <?php $category= $category->affichercategory(); foreach ($category as $row) { echo "<option value=".$row['id_category'] . ">" . $row['Nom'] . "</option>"; } ?>
                </select> 
            </div>
            <div class="mb-4">
            <label for="tags" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select tags</label> 
         <div id="tags" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
             <?php $tags= $tags-> afficherTags(); foreach ($tags as $row) { echo '<div class="flex items-center mb-2">'; echo '<input id="tag-' . $row['id_tag'] . '" type="checkbox" name="id_tag" value="' . $row['id_tag'] . ' " class="mr-2">'; echo '<label for="tag-' . $row['id_tag'] . '" class="text-gray-900 dark:text-white">' . $row['Nom'] . '</label>'; echo '</div>'; } ?> 
</div>
            <div class="flex justify-end mt-10">
                <input type="submit" value="modifie" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
            </div>
        </form>
    </div>

</body>
</html>

