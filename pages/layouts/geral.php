<?php
if (isset($_SESSION['id'])) {
    $email = $_SESSION['email'];
} else {
    session_start();
    if (isset($_SESSION['id'])) $email = $_SESSION['email'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Questions </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <?php
    if (getcwd() == 'C:\xampp\htdocs\gameBiblico') {
        echo "<link rel='stylesheet' href='././src/css/geral.css'>";
        echo "<link rel='stylesheet' href='././src/css/userPage.css'>";
        echo "<link rel='stylesheet' href='././src/css/niveis.css'>";
        include "./pages/register_login/alerts.php";
    } else {
        echo "<link rel='stylesheet' href='../../src/css/geral.css'>";
        echo "<link rel='stylesheet' href='../../src/css/userPage.css'>";
        include "../register_login/alerts.php";

        if (getcwd() == 'C:\xampp\htdocs\gameBiblico\pages\register_login') {
            echo "<link rel='stylesheet' href='../../src/css/admin.css'>";
        } else if (getcwd() == 'C:\xampp\htdocs\gameBiblico\pages\admin') {
            echo "<link rel='stylesheet' href='../../src/css/admin.css'>";
        } else {
            echo "<link rel='stylesheet' href='../../src/css/niveis.css'>";
        }
    }

    // / if (getcwd() == 'C:\xampp\htdocs\gameBiblico') {
    //     //     // echo "<link rel='stylesheet' href='././src/css/userPage.css'>";
    
    //     //     $folderActual = "index";
    //     //     $folderRegst = "./src/register";
    //     //     $folderPages = "./pages/register_login";
    
    //     // } 
    
    
    //     {
    //         for ($i = 1; $i <= 7; $i++) {
    //             if (getcwd() == 'C:\xampp\htdocs\gameBiblico\pages') {
    //                 echo "<link rel='stylesheet' href='../../src/css/niveis.css'>";
    //             }
    //         }
    
    //         $folderActual = "insidePages";
    //         $folderRegst = "../../src/register";
    //         $folderPages = "../../pages/register_login";
    
    //         echo "<link rel='stylesheet' href='../../src/css/geral.css'>";
    //         echo "<link rel='stylesheet' href='../../src/css/userPage.css'>";
    //     }
    
    

    ?>

</head>

<body>
    <main class="p-4">
        <div class="position-absolute top-0 d-flex justify-content-between align-items-center w-100 p-4">
            <button class="btnG btnSimple px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling"> <span><i class="bi bi-list"></i></span>
            </button>

            <?php if (!isset($email)) : ?>
                <a href='<?php echo $folderPages; ?>/login.php' class="inkUser" class='btnG'> login </a>
            <?php else : ?>
                <div class="btn-group">
                    <button id="btnUser" class="btnG btnSimple" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php echo $email; ?>
                    </button>
                    <ul id="divUserNav" class="dropdown-menu">
                        <div>
                            <div>
                                <a href='<?php echo $folderRegst; ?>/profile.php' class="inkUser"> profile
                            </div>
                            </a>
                            <a href='<?php echo $folderRegst; ?>/logout.php' class="inkUser">
                                <div>logout</div>
                            </a>
                        </div>
                    </ul>
                </div>
            <?php endif; ?>
        </div>

        <nav class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div>
                    <?php
                    if (isset($folderActual) && $folderActual == 'insidePages') :
                    ?>
                        <a href="../../index.php">
                            <h1> Logo </h1>
                        </a>
                    <?php
                    else :
                    ?>
                        <h1> Logo </h1>
                    <?php
                    endif;
                    ?>
                </div>
                <p>Try scrolling the rest of the page to see this option in action.</p>
            </div>
        </nav>