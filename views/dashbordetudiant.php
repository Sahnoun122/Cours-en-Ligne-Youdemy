<?php
session_start();

require_once '../database/db.php';
 require_once '../classes/coursvideo.php';
 require_once '../classes/etudiant.php';

 echo $_SESSION['id_user'];
$db= new DbConnection();
$pdo= $db->getConnection();

$coursvideo= new Coursvideo($pdo);

$coursvideo_ = $coursvideo->afficherCours();

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

<aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-80 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full overflow-y-auto bg-black">
    <!-- Sidebar Menu -->
    <div class="flex flex-col">
   

      <ul class="space-y-2 font-medium px-3 pb-4">
        <li>
            <a href="dashbordetudiant.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
               <span class="ms-3">Dashboard</span>
            </a>
        </li>
     
     
      
      
     
      </ul>
   </div>
</aside>


<!-- Main -->
 
<div class="p-8 sm:ml-80">
    <h2 class="text-4xl font-semibold text-black mb-6">Cours</h2>

    </div>
</div>

<div class="p-4 sm:ml-80">
<div id="articlesContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
    <?php
    if (is_array($coursvideo_) || is_object($coursvideo_)) {
        foreach ($coursvideo_ as $cours) {
            ?>
            <div class="bg-black shadow-lg rounded-lg overflow-hidden" data-category="<?php echo htmlspecialchars($cours['id_category'], ENT_QUOTES, 'UTF-8'); ?>" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="p-4">
                    <h3 class="text-2xl mb-2 font-semibold text-white"><?php echo htmlspecialchars($cours['Titre'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($cours['DESCRIPTION'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <video src="<?php echo htmlspecialchars($cours['video'], ENT_QUOTES, 'UTF-8'); ?>" alt="video" class="w-full h-32 object-cover rounded-md mb-2"></video>

                    <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($cours['NomCategorie'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($cours['NomTag'], ENT_QUOTES, 'UTF-8'); ?></p>


                    <form method="POST" action="../action/etudiantiaction.php" class="mt-4">
                    <input type="hidden" name="inscrire" value="1"> 
                    <input type="hidden" name="id_cours" value="<?php echo htmlspecialchars($cours['id_cours'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="flex items-center space-x-4">
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">S'inscrire</button>
                    </div>
                </form>
                </div>
            </div>
            <?php
        }
    } else {
        echo "No data available or incorrect data format.";
    }
    ?>
</div>

</div>

 

</div>

<script>
  AOS.init();
</script>

</body>
</html>