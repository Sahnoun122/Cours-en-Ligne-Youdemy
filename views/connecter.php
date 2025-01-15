

<?php 


   require_once '../database/db.php';
   require_once '../classes/user.php';
   session_start();

  $db = new DbConnection();
  $pdo = $db->getConnection();

   $auth = new User($pdo);

   if($_SERVER['REQUEST_METHOD' ] === 'POST'){
    $email = $_POST['Email'];
    $Motdepasse = $_POST['Motdepasse'];

    try{
        $user= $auth->login($email , $Motdepasse);

        $_SESSION ['id_user'] = $user['id_user'];
        $_SESSION['Email'] = $user['Email'];
        $_SESSION['Nom']= $user['Nom'];
        $_SESSION['ROLE']= $user['ROLE'];

        if($user['ROLE']=== 'admin'){
            header('Location:dashbordadmin.php');
        }else if($user ['ROLE'] === 'etudiant'){
            header('Location:dashbordetudiant.php');
        }else if ($user['ROLE'] === 'enseignant'){
            header('Location:dasbordenseignant.php');
        }
        exit();
    }catch (Exception $e){
        echo "errour " . $e->getMessage();
    }
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="../assets/gym.png"/>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- AOS Animation CDN -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<body style="margin: 0;
            padding: 0;
            background-image: url('../assets/scriptsql/img/multi-verse-7970350_1280.jpg');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;">

<div class="flex flex-col items-center justify-between pt-0 pr-10 pb-0 pl-10 mt-28 mr-auto mb-0 ml-auto max-w-7xl xl:px-5 lg:flex-row">
    <div class="flex flex-col items-center w-full pt-5 pr-10 pb-20 pl-10 lg:pt-20 lg:flex-row">
        <div class="w-full bg-cover relative max-w-md lg:max-w-2xl lg:w-7/12">
            <div class="flex flex-col items-center justify-center w-full h-full relative lg:pr-10" data-aos="fade-right" data-aos-easing="ease-in-sine" data-aos-duration="800">
                <h1 class="text-9xl text-white font-bold" style="text-shadow: 4px 4px 8px rgba(0, 0, 0, 0.75);">
                Unleash Your Potential
                </h1>
            </div>
        </div>
        <div class="w-full mt-20 mr-0 mb-0 ml-0 relative z-10 max-w-2xl lg:mt-0 lg:w-5/12">
            <div class="flex flex-col items-start justify-start pt-10 pr-10 pb-10 pl-10 bg-white shadow-2xl rounded-xl
                relative z-10">

                <form method="POST" class="w-full mt-6 mr-0 mb-0 ml-0 relative space-y-8">
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                            absolute">Email</p>
                        <input type="text" name="Email" placeholder="Email" required class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md"/>
                    </div>
                    <div class="relative">
                        <p class="bg-white pt-0 pr-2 pb-0 pl-2 -mt-3 mr-0 mb-0 ml-2 font-medium text-gray-600
                            absolute">Password</p>
                        <input type="password" name="Motdepasse" placeholder="•••••••" required class="border placeholder-gray-400 focus:outline-none
                            focus:border-black w-full pt-4 pr-4 pb-4 pl-4 mt-2 mr-0 mb-0 ml-0 text-base block bg-white
                            border-gray-300 rounded-md"/>
                    </div>
                    <div class="relative">
                        <button type="submit" class="w-full inline-block pt-4 pr-5 pb-4 pl-5 text-xl font-medium text-center text-white bg-green-500
                            rounded-lg transition duration-200 hover:bg-green-600 ease">Login</button>
                    </div>
                    <div class="relative">
                        <p class="text-center font-medium text-gray-600">You don't have an account, <a href="register.php" class="text-green-600 font-bold">Register</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>



<script>
  AOS.init();
</script>

</body>
</html>