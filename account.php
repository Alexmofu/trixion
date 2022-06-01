<?php
//SESSION START
session_start();

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
    <title>Trixion - Account</title>
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
        <div id="main" class="main">
            <!-- Home Landing -->

<!-- REGISTRATION FORM -->
<?php
if (!isset($userSession)){
?>

<div class="accountAuth noselect mqr">

    <div class="accountLogin loginmqr">
        <h1>Login</h1>
        <span id="loginerror"></span>
        <form id="loginform">
            <input type="text" autocomplete="username" name="username" placeholder="username / email">
            <input type="password" autocomplete="current-password" name="password" placeholder="password">
            <button type="submit" name="submit">Login</button>
        </form>
            <div id="newAccountLogin">or.. <span id="openSignup">Create an Account</span></div>
    </div>

    <div class="accountSignup loginmqr">
        <h1>Sign up</h1>
        <span id="signuperror"></span>
        <form id="signupform">
            <input type="text" autocomplete="username" name="username" placeholder="username">
            <input type="password" autocomplete="new-password" name="password" placeholder="password">
            <input type="password" autocomplete="new-password" name="password_repeat" placeholder="repeat password">
            <input type="email" name="email" placeholder="your@mail.com"> 
            <button type="submit" name="submit">Sign up</button>
        </form>
            <div id="newAccountLogin">or.. <span id="closeSignup">Log in</span></div>
    </div>

    
</div>

<?php
}
if(isset($userSession)){
?>

<div class='account noselect mqr'>

    <!-- Account Details -->
    <div class='account-details account-content'>
        <h1>Account</h1>
        <span class="userError"></span>
        <form name='accountmanagementform' method='post'>
            <input type='text' class='accountformInput inputDisabled' value="<?php echo $userData[0]['username'];?>" placeholder="<?php echo $userData[0]['username'];?>" disabled> <!-- This wont do anything if you manually remove disabled LOL -->
            <input type='email' name='newEmail' class='accountformInput' placeholder='Email'>
            <input type='password' name='oldPassword' class='accountformInput' placeholder='Current Password'>
            <input type='password' name='newPassword' class='accountformInput' placeholder='New Password'>
            <input type='submit' id='accountDetailsSave' class='accountbtn' value='Save Changes'>
        </form>
    </div>
    <!-- Account Guild -->
    <div class='account-guild account-content'>
        <h1>Guild</h1>
        <span id="guildError"></span>
    <?php
    $guildRole = $userData[0]['guild_role'];
    $guildId = $userData[0]['id_guild'];
    if(isset($guildData)){
    $guildSecret = $guildData[0]['password'];
    }

    if($guildId == ""){
    ?>
        <form id="newGuild">
            <input type='text' name='guildName' class='accountformInput' placeholder='New Guild Name'>
            <input type="submit" name="submit" id='accountGuildCreate' class='accountbtn' value='Create New Guild'>    
        </form>

        <form id="joinGuild">
            <input type='text' name='accountGuildCode' class='accountformInput' placeholder='Join Code'>
            <input type="submit" name="submit" id='accountGuildJoin' class='accountbtn' value='Join Existing Guild'>
        </form>

    <?php
    }
    ?>
        <?php
        if(!empty($guildId) & $guildRole == 'member'){?>
            <form id="leaveGuild">
                <input type='text' class='accountformInput inputDisabled' value="<?php echo $guildData[0]['name'];?>" placeholder="<?php echo $guildData[0]['name'];?>" disabled> 
                <input id="guildSecret" readonly="readonly" class='accountformInput' value="<?php echo $guildSecret ?>"></input>
                <input type="submit" name="submit" id='accountGuildLeave' class='accountbtn' value='Leave Guild'>
            </form>
        <?php 
        }
        ?>
    <?php
    if($guildRole == "officer"){
    ?>
            <form id="leaveGuild">
                <input type='text' class='accountformInput inputDisabled' value="<?php echo $guildData[0]['name'];?>" placeholder="<?php echo $guildData[0]['name'];?>" disabled> 
                <input id="guildSecret" readonly="readonly" class='accountformInput' value="<?php echo $guildSecret ?>"></input>
                <a style="text-decoration: none;" href="./guildmanager"><input type="button" class='accountbtn' value='Guild Manager'></a>
                <input type="submit" name="submit" id='accountGuildLeave' class='accountbtn' value='Leave Guild'>
            </form>
            
    <?php
    }
    ?>
    <?php
    if($guildRole == "admin"){
    ?>
        <form id="disbandGuild">
            
            <input type='text' class='accountformInput inputDisabled' value="<?php echo $guildData[0]['name'];?>" placeholder="<?php echo $guildData[0]['name'];?>" disabled> 
            <input id="guildSecret" readonly="readonly" class='accountformInput' value="<?php echo $guildSecret ?>"></input>
            <br>
            
            <a style="text-decoration: none;" href="./guildmanager"><input type="button" class='accountbtn' value='Guild Manager'></a>
            <input type="submit" name="submit" id='accountGuildDisband' class='accountbtn' value='Disband Guild'>
        </form>
        <?php
    }
        ?>
    </div>
    <!-- Account Characters -->
    <div class='account-characters account-content'>
        <h1>Characters</h1>
        <ul>
            <!-- NEW CHARACTER -->
            <form id="newCharacterForm">
            <span class="characterError"></span>
                <li class='' id='addAccountCharacter'><span id="addCharacterSpan">+</span></li>
                    <div class='characterDetails'>
                        <div class='charnameEdit'>
                            <span>Name</span>
                            <br>
                            <input type='text' maxlength="16" name='characterName' class='accountformInput' placeholder='Name'>
                        </div>
                        <div class='classEdit'>
                            <span>Class</span>
                            <br>
                            <select class='classSelect' name='characterClass' id='newClassSelect'>
                            <?php
                            $allClasses = $main->getAllClasses();
                            foreach($allClasses as $class){
                                $classSelector = '<option value="'.$class['id_class'].'">'.$class['subclass'].'</option>';
                                echo $classSelector;
                            }
                            ?>
                            </select>
                        </div>
                        <div class='ilvlEdit'>
                            <span>Item Level</span>
                            <br>
                            <input type="number" min="0" maxlength="4" pattern="[0-9]*" inputmode="numeric" name='characterIlvl' class='accountformInput' placeholder='Ilvl'>
                        </div>
                        <div></div>  <!-- Empty div for grid -->
                        <div class='sendEdit'>
                        <button name="submit" class='accountbtn'>Save</button>
                        
                        </div>
                    </div>
            </form>
            <!-- /END CHARACTER -->
            <?php
               $characters = $main->getUserCharacters($userSession);
               foreach($characters as $character){
                $charecho = '
                
                <form class="characterForm">
                <span class="characterError"></span>
                <li class="CharacterDetailOpen">'.$character['name'].'</li><div class="deleteCharacter"></div>
                <div class="characterDetails">
                <input type="hidden" class="characterId" name="characterId" value='.$character['id_character'].'> <!-- Changing this hidden value does nothing btw, checks backend before updating LOL -->
                        <div class="charnameEdit">
                            <span>Name</span>
                            <br>
                            <input type="text" maxlength="16" name="characterName" class="accountformInput" placeholder="Name" value="'.$character['name'].'">
                        </div>
                        <div class="classEdit">
                            <span>Class</span>
                            <br>
                            <select class="classSelect" name="characterClass">
                ';
                            foreach($allClasses as $class){
                                if($character['id_class'] == $class['id_class']){
                                    $charecho .= '<option selected value="'.$class['id_class'].'">'.$class['subclass'].'</option>';
                                }else{
                                    $charecho .= '<option value="'.$class['id_class'].'">'.$class['subclass'].'</option>';
                                }
                            }
                $charecho .= '

                            </select>
                        </div>
                        <div class="ilvlEdit">
                            <span>Item Level</span>
                            <br>
                            <input type="number" maxlength="4" min="0" pattern="[0-9]*" inputmode="numeric" name="characterIlvl" class="accountformInput" placeholder="Ilvl" value="'.$character['ilvl'].'">
                        </div>
                        <div></div>  <!-- Empty div for grid -->
                        <div class="sendEdit">
                        <button name="submit" class="accountbtn">Save</button>                        
                        </div>
                    </div>
                </form>
                ';

                echo $charecho;

               }
            ?>
        </ul>
    </div>
</div>
<?php
}
?>


            </div> <!-- // Home Landing --> 
        </div>
    </div>
    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>
</body>
</html>