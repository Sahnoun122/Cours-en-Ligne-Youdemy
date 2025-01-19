<?php
session_start();

require_once '../database/db.php';
require_once '../classes/admin.php';



$db= new DbConnection();
$pdo= $db->getConnection();

$admin = new Admin($pdo);
$admin_= $admin-> voirprofile() ;

$topTeachers = $admin->getTopTeachers();
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
            <a href="dashbordadmin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
               <span class="ms-3">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="ajoutercategory.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
               </svg>
               <span class="ms-3">category</span>
            </a>
        </li>
        <li>
            <a href="ajoutertags.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
               </svg>
               <span class="ms-3">Tags</span>
            </a>
        </li>
        <li>
            <a href="inscriptionadmin.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
               </svg>
               <span class="ms-3">les inscription</span>
            </a>
        </li>
        <li>
            <a href="consulterprofile.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                  <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
               </svg>
               <span class="ms-3">les profils</span>
            </a>
        </li>
      
        <li>
            <a href="logout.php" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-100 hover:text-black group">
               <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3"/>
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Log Out</span>
            </a>
        </li>
      </ul>
   </div>
</aside>
<div class="p-8 sm:ml-80">


<div class="container mx-auto p-8">
    <?php
    if ($topTeachers) {
        echo "<h2 class='text-4xl font-semibold text-black mb-6'>Top 3 Enseignants</h2>";
        echo "<table class='table-auto w-full bg-white shadow-md rounded-lg'>";
        echo "<thead>";
        echo "<tr class='bg-gray-200 text-left'>";
        echo "<th class='px-4 py-2'>Nom</th>";
        echo "<th class='px-4 py-2'>Prénom</th>";
        echo "<th class='px-4 py-2'>Nombre de Cours</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($topTeachers as $teacher) {
            echo "<tr>";
            echo "<td class='border px-4 py-2'>" . htmlspecialchars($teacher['teacher_name'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td class='border px-4 py-2'>" . htmlspecialchars($teacher['teacher_surname'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td class='border px-4 py-2'>" . htmlspecialchars($teacher['number_of_courses'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<h2 class='text-4xl font-semibold text-black mb-6'>Erreur de récupération des enseignants</h2>";
    }
    ?>


    <h2 class="text-4xl font-semibold text-black mb-6">profils</h2>

    
<div class="flex items-center justify-center overflow-x-auto shadow-lg rounded-lg" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
    <table class="min-w-full table-auto border-collapse bg-white">
        <thead class="bg-black">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-medium text-white">Nom</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white">Prenom</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white">Email</th>
                <th class="px-6 py-3 text-left text-sm font-medium text-white">Role</th>

            </tr>
        </thead>
        <tbody>


        <?php 
if (is_array($admin_) || is_object($admin_)) {
    foreach ($admin_ as $profile) {
        if (isset($profile['id_user'])) {
            echo '<tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm">'.$profile['Nom'].'</td>
                <td class="px-6 py-4 text-sm">'.$profile['Prenom'].'</td>
                <td class="px-6 py-4 text-sm">'.$profile['Email'].'</td>
                <td class="px-6 py-4 text-sm">'.$profile['ROLE'].'</td>
                <td class="px-6 py-4 text-sm">
                    <form method="post" action="../action/adminaction.php">
                        <input type="hidden" name="supprimer" value="'.$profile['id_user'].'">
                        <button type="submit" class="bg-red-500 text-white px-3 py-1">Supprimer</button>
                    </form>
                </td>
            </tr>';
        } else {
            echo '<tr class="border-b hover:bg-gray-50">
                <td class="px-6 py-4 text-sm" colspan="5">ID de l\'utilisateur non trouvé.</td>
            </tr>';
        }
    }
} else {
    echo "No articles found.";
}
?>

?>

        
        </tbody>
    </table>
</div>

</div>

 

</div>
<script>
  AOS.init();
</script>

</body>
</html>