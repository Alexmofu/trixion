<?php
//SESSION START
session_start();

//DEBUG ERROR HANDLER
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

/* AUTOLOADER */
include './php/backend/includes/class-autoload.inc.php';
?>

<?php
$reauthuser = new ReAuth();
$reauthuser->reAuthUser();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, user-scalable=0">
    <title>Trixion - Planner App</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src="https://kit.fontawesome.com/f95bd0d248.js" crossorigin="anonymous"></script>
    <!-- META TAGS -->
    <meta property="og:title" content="Trixion Planner">
    <meta property="og:site_name" content="trixion.net">
    <meta property="og:url" content="https://www.trixion.net">
    <meta property="og:description" content="Lost Ark fan-made site: · Daily Planner · Guild 'in-need' market · Guild Event Manager">
    <meta property="og:type" content="website">
    <meta property="og:image" content="../public/img/hexfield-logo.svg">
    <meta name="theme-color" content="#2a2f55">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="./favicon//apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon//favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./favicon/favicon-16x16.png">
    <link rel="manifest" href="./favicon/site.webmanifest">
</head>
<body>

<?php
$main = new Main();
if(isset($_SESSION["id_user"])){
$userSession = $_SESSION["id_user"];

$userData = $main->getUserData($userSession);
$userData = json_decode($userData, true);
}
?>

    <!-- SideBar -->
    <div class="sidebar noselect">
        <div class="navbartop">
            <i id="hamburger" class="fa-solid fa-bars fa-2xl"></i>
        </div>
        <div class="logo">
            <span>Trixion</span>
            <img src="./public/img/hexfield-logo.svg">
        </div>
        <div class="wrapperlittle mqr">  
            <div class="scrollwrapper">
        <a class="selectedSidebar" id="home"><img src="./public/img/faicons/house-solid.svg">Home</a>
        <!-- <a id="dashboard"><img src="./public/img/faicons/book-open-reader-solid.svg"> Dashboard</a> -->
        <a id="guildplanner"><img src="./public/img/faicons/sitemap-solid.svg">Guild Planner</a>
        <!-- <a id="guildmarket"><img src="./public/img/faicons/store-solid.svg">Guild Market</a>
        <a id="dailyplanner"><img src="./public/img/faicons/calendar-check-solid.svg">Daily Check</a> -->
        <a id="support"><img src="./public/img/faicons/life-ring-solid.svg">Support</a>
        <a id="account"><img src="./public/img/faicons/user-solid.svg">Account</a>
        <a id="about"><img src="./public/img/faicons/circle-question-solid.svg">About</a>
        <?php
        if(isset($userSession)){
        ?>
        <a href="./php/backend/includes/Logout.inc.php" id="logoutbtn">Logout</a>
        <?php
        }
        ?>
        <?php 
        if(isset($userSession)){
            echo "<a id='usersidebar' class='usersidebar'>".$userData[0]['username']."";
            if(isset($userData[0]['id_guild'])){
                $guildData = $main->getGuildData($userData[0]['id_guild']);
                $guildData = json_decode($guildData, true);

                echo "<br>". $guildData[0]['name'] ."</a>";
            }else{
                echo "</a>";
            }
        }else{
            echo "<a id='usersidebar' class='usersidebar'></a>";
        }
        ?>
        
        </div>      
    </div>
    </div>
    <!-- Content -->
    <div class="content">
        <div id="main" class="main">
            <!-- Home Landing -->

            <div class="home noselect">
                <span class="home-header mqr">Trixion</span>
                    <div class="container mqr">
                        <!-- Feature Full 1 -->
                        <div class="feature featurefull1">
                            <h1>Guild Planner</h1>
                            <div class="featuredetails">
                                <span>Easily manage new events for your guild and let your guildmembers join activities</span>
                                <br>
                                <img id="guildPlannerhome" src="./public/img/home/guildPlanner.webp">
                            </div>          
                        </div>
                    </div>
            </div> <!-- // Home Landing --> 
        </div>
    </div>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>
</body>
</html>