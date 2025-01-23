<?php
session_start();

require_once '../database/db.php';
 require_once '../classes/coursvideo.php';
 require_once '../classes/etudiant.php';
 require_once '../classes/cours.php';

//  if (!isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'etudiant') {
//     header("Location:connecter.php");
//     exit;
// }


echo $_SESSION['id_user'];
$db= new DbConnection();
$pdo= $db->getConnection();

$course = new Coursvideo($pdo);
$id_cours = isset($_GET['id']) ? intval($_GET['id']) : 0;
$courses = $course->getdetails($id_cours);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="../assets/gym.png"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
            <!-- AOS Animation CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body class="bg-gray-100">

<!-- Main -->
<button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>



<!-- Main -->
 
<div class="p-8 sm:ml-80">
    <h2 class="text-4xl font-semibold text-black mb-6">Cours</h2>

    </div>
</div>

<div class="p-4 sm:ml-80">
<div id="articlesContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
    <?php if ($courses): ?>
    <div class="bg-black shadow-lg rounded-lg overflow-hidden">
        <div class="p-4">
            <h3 class="text-2xl mb-2 font-semibold text-white"><?php echo htmlspecialchars($courses['Titre'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($courses['DESCRIPTION'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a href="details.php?id=<?php echo htmlspecialchars($courses['id_cours'], ENT_QUOTES, 'UTF-8'); ?>">
                <video src="<?php echo htmlspecialchars($courses['video'], ENT_QUOTES, 'UTF-8'); ?>" alt="video" class="w-full h-52 object-cover rounded-md mb-2"></video>
            </a>
            <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($courses['Nom'], ENT_QUOTES, 'UTF-8'); ?></p>

            <form method="POST" action="../action/etudiantiaction.php" class="mt-4">
                <input type="hidden" name="inscrire" value="1">
                <input type="hidden" name="id_cours" value="<?php echo htmlspecialchars($courses['id_cours'], ENT_QUOTES, 'UTF-8'); ?>">
                <div class="flex items-center space-x-4">
                </div>
            </form>
        </div>
    </div>
<?php endif; ?>
</div>

</div>

 

</div>

<script>
  AOS.init();
</script>

</body>
</html>