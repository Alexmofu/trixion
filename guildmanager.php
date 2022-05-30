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
    <title>Trixion - Guild Manager</title>
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

<?php
if(isset($userData[0]['guild_role'])){ 
    if($userData[0]['guild_role'] == 'member'){
    header("Location: https://www.trixion.net/account");
    }
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
        <a id="home"><img src="./public/img/faicons/house-solid.svg">Home</a>
        <!-- <a id="dashboard"><img src="./public/img/faicons/book-open-reader-solid.svg"> Dashboard</a> -->
        <a id="guildplanner"><img src="./public/img/faicons/sitemap-solid.svg">Guild Planner</a>
        <!-- <a id="guildmarket"><img src="./public/img/faicons/store-solid.svg">Guild Market</a>
        <a id="dailyplanner"><img src="./public/img/faicons/calendar-check-solid.svg">Daily Check</a> -->
        <a id="support"><img src="./public/img/faicons/life-ring-solid.svg">Support</a>
        <a class="selectedSidebar" id="account"><img src="./public/img/faicons/user-solid.svg">Account</a>
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
        <div id="main" class="main">    <!-- Home Landing -->            
            <div class="guildManager mqr">
                <div class="guildManagerTopWrapper">
                    <h1 class="noselect">Guild Manager</h1>
                    <input placeholder="Search" type="text" class="guildManagerSearch noselect">
                </div>
                <div class="guildManagerContent mqr">

                
                <?php
                    if(isset($userData[0]['guild_role'])){ 
                        if($userData[0]['guild_role'] == 'admin' || $userData[0]['guild_role'] == 'officer'){  /*FULL PERMISSIONS -- ADDING OFFICER HERE UNTIL MORE FUNCTIONS ARE ADDED TO THE SITE */ ?>
                    <!-- ADMIN CONTENT -->
                    <ul>
                        <li>
                            <div class="guildMember mqr">
                                <div class="memberContainer mqr noselect">
                                    <div class="memberName">USERNAME</div>
                                    <div class="memberRole">ROLE</div>
                                    <div class="memberActions"></div>
                                </div>
                            </div>
                        </li>
                    <?php
                        $guildMembers = $main->getGuildMembers($userData[0]['id_guild']);
                        $guildMembers = json_decode($guildMembers, true);
                        foreach($guildMembers as $member){
                            $out = '
                            <li class="guildMemberLi">
                            <div class="guildMember mqr">
                            
                                <form class="guildMember mqr">
                                    <div class="memberContainer mqr">
                                        <div name="memberName" class="memberName">'.$member['username'].'</div>
                                        <div name="memberClass" class="memberRole noselect">
                                            <select class="classSelect" name="userRole">
                                            ';
                                                if($member['guild_role'] == "officer"){
                                                    $out .= '<option selected value="'.$member['guild_role'].'">'.$member['guild_role'].'</option>';
                                                    $out .= '<option value="member">member</option>';
                                                }else if($member['guild_role'] == "member"){
                                                    $out .= '<option value="officer">officer</option>';
                                                    $out .= '<option selected value="'.$member['guild_role'].'">'.$member['guild_role'].'</option>';
                                                }else if($member['guild_role'] == "admin"){
                                                    $out .= '<option selected disabled value="admin">admin</option>';
                                                }
                                            $out .= '
                                            </select>
                                        </div>
                                        ';
                                        if($member['guild_role'] != "admin"){
                                        $out .= '<div class="memberActions noselect"><div class="memberKick tooltip"><span class="tooltiptext">Kick User</span></div></div>';
                                        }
                                        $out .= '
                                    </div>
                                </form>
                            
                            </div>
                            </li>
                            ';
                            echo $out;
                        }
                    ?>
                    </ul>

                    <!-- END ADMIN CONTENT -->
                    <?php }} 
                    if(isset($userData[0]['guild_role'])){
                        if($userData[0]['guild_role'] == 'officer'){  /* OFFICER ONLY PERMISSIONS - PLACEHOLDER UNTIL NEEDED*/ ?>
                            <!-- OFFICER CONTENT -->
                            <!-- END OFFICER CONTENT -->
                    <?php }} ?> 
                    
                </div>
            </div>
        </div> <!-- // Home Landing --> 
        </div>
    </div>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>
</body>
</html>