
<?php
session_start();

require_once '../database/db.php';
require_once '../classes/admin.php';
require_once '../classes/tags.php';

$db = new DbConnection();
$pdo= $db->getConnection();

$admin= new Admin($pdo);

$tags = new Tags($pdo);

$tags_ = $tags->afficherTags();



// if ($_SERVER['REQUEST_METHOD']==='POST') {
//     $tags=$_POST['tags'];
//     foreach ($tags as $tag) {
//         $tagTitle=trim(htmlspecialchars($tag));
//         $tags_= $tags-> afficherTags();
//         if ( $tags_) {
//             header('Location:ajouter');
//         }else {
//             echo "Failed to add tags";
//         }
//     }
// }

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

    <h2 class="text-4xl font-semibold text-black mb-10">Tags</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-12" style="align-items: start;">
    <?php
    if (!empty($tags_)) {
        foreach ($tags_ as $tag) {
    ?>
    <div class="bg-black shadow-lg rounded-lg overflow-hidden" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
        <div class="p-6">
            <h3 class="text-4xl mb-4 font-semibold text-white"><?php echo htmlspecialchars($tag['Nom']); ?></h3>
            
        </div>
        <form method="POST" action="../action/actiontag.php" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                <div class="flex items-center justify-center mt-4">
                    <button type="submit" class="text-xl hover:scale-105" name="delete" value="<?php echo $tag['id_tag']; ?>">🗑️</button>
                </div>
            </form>
    </div>
    <?php
        }
    } else {
        echo "<p class='text-white'>No tags found.</p>";
    }
    ?>
</div>
</div>



    <h2 class="text-4xl font-semibold text-black mb-6">Add New Tags</h2>
    <div class="flex items-center justify-center my-8 bg-gray-100">
        <div class="w-full mx-0 relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
            <div class="p-10 bg-white shadow-2xl rounded-xl relative z-10" data-aos="fade-right">



            

            <form method="POST" action="../action/actiontag.php" id="tagsForm" class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8">
                <div class="relative">
                    <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600 absolute">Tags Name</p>
                    <input type="text" id="Nom" name="Nom[]" required class="border placeholder-gray-400 focus:outline-none focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white border-gray-300 rounded-md"/>
                    <button type="button" id="addTagButton" class="w-full inline-block pt-2 pr-4 pb-2 pl-4 text-lg font-medium text-center text-white bg-blue-500 rounded-lg transition duration-200 hover:bg-blue-600 ease">Add Another Tag</button>
                </div>
                <div class="relative">
                    <button type="submit" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-green-500 rounded-lg transition duration-200 hover:bg-green-600 ease">Ajouter Tags</button>
                </div>
            </form>



            </div>
        </div>
    </div>

</div>

<script>

document.getElementById('addTagButton').addEventListener('click', function() {
    var newInput = document.createElement('input');
    newInput.type = 'text';
    newInput.name = 'Nom[]';
    newInput.required = true;
    newInput.classList.add('border', 'placeholder-gray-400', 'focus:outline-none', 'focus:border-black', 'w-full', 'pt-4', 'pr-4', 'pb-4', 'pl-4', 'mt-2', 'mr-0', 'mb-0', 'ml-0', 'text-base', 'block', 'bg-white', 'border-gray-300', 'rounded-md');

    var form = document.getElementById('tagsForm');
    form.insertBefore(newInput, form.children[form.children.length - 2]);
});

</script>
<script>
  AOS.init();
</script>

</body>
</html>