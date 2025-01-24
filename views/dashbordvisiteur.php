<?php

require_once '../database/db.php';
require_once '../classes/etudiant.php';
require_once '../classes/coursvideo.php';


$db= new DbConnection();
$pdo= $db->getConnection();

$coursvideo= new Coursvideo($pdo);

$etudiant = new Etudiant($pdo);

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if ($searchTerm) {
  $coursvideo_ = $etudiant->searchCourses($searchTerm);
} else {
  $coursvideo_ = $coursvideo->affichercoursetudiants();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<body>



<nav class="bg-white border-gray-200 dark:bg-gray-900">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
        </li>
        <li>
            <a href="register.php"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Register</button>            </a>
        </li>
        <li>
            <a href="connecter.php"><button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Se Connecter</button>            </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <form method="GET" action="" class="w-80 flex items-center space-x-4 ml-80">
        <input id="search" name="search" value="<?php echo $searchTerm; 
        ?>" onchange="this.form.submit()" class="block w-full max-w-sm px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Search courses..." />
  </form>

  
<div class="p-4 sm:ml-80">
<div id="articlesContainer" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12">
    <?php
    if (is_array($coursvideo_) || is_object($coursvideo_)) {
        foreach ($coursvideo_ as $cours) {
            ?>
            <div class="bg-black shadow-lg rounded-lg overflow-hidden"  >
                <div class="p-4">
                    <h3 class="text-2xl mb-2 font-semibold text-white"><?php echo htmlspecialchars($cours['Titre'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($cours['DESCRIPTION'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <a href="details.php?id=<?php echo $cours['id_cours']; ?>"> <video src="<?php echo htmlspecialchars($cours['video'], ENT_QUOTES, 'UTF-8'); ?>" alt="video" class="w-full h-52 object-cover rounded-md mb-2"></video></a>

                    <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($cours['NomCategorie'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="text-sm text-white mb-2"><?php echo htmlspecialchars($cours['NomTag'], ENT_QUOTES, 'UTF-8'); ?></p>
                
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


    
</body>
</html>