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
    <title>Trixion - Guild Planner</title>
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
    if (isset($_SESSION["id_user"])) {
        $userSession = $_SESSION["id_user"];

        $userData = $main->getUserData($userSession);
        $userData = json_decode($userData, true);
    }
    ?>

    <?php
    if (!isset($userData[0]['id_guild'])) {
        header("Location: https://www.trixion.net/account");
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
                <a class="selectedSidebar" id="guildplanner"><img src="./public/img/faicons/sitemap-solid.svg">Guild Planner</a>
                <!-- <a id="guildmarket"><img src="./public/img/faicons/store-solid.svg">Guild Market</a>
                <a id="dailyplanner"><img src="./public/img/faicons/calendar-check-solid.svg">Daily Check</a> -->
                <a id="support"><img src="./public/img/faicons/life-ring-solid.svg">Support</a>
                <a id="account"><img src="./public/img/faicons/user-solid.svg">Account</a>
                <a id="about"><img src="./public/img/faicons/circle-question-solid.svg">About</a>
                <?php
                if (isset($userSession)) {
                ?>
                    <a href="./php/backend/includes/Logout.inc.php" id="logoutbtn">Logout</a>
                <?php
                }
                ?>

                <?php
                if (isset($userSession)) {
                    echo "<a id='usersidebar' class='usersidebar'>" . $userData[0]['username'] . "";
                    if (isset($userData[0]['id_guild'])) {
                        $guildData = $main->getGuildData($userData[0]['id_guild']);
                        $guildData = json_decode($guildData, true);

                        echo "<br>" . $guildData[0]['name'] . "</a>";
                    } else {
                        echo "</a>";
                    }
                } else {
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
            <div class="guildPlanner mqr">
                <!-- CONTENT -->
                <div class="guildPlannerContent mqr">

                    <?php
                    $eventList = $main->getEventList($userData[0]['id_guild']);
                    $eventList = json_decode($eventList, true);
                    
                    foreach ($eventList as $event) {
                    $participants = $main->getEventParticipants($userData[0]['id_guild'], $event['id_event']);
                    $participants = json_decode($participants, true);
                    $isInEvent = $main->checkCharacterInEvent($userSession, $event['id_event']);
                    $isInEvent = json_decode($isInEvent, true);
                        $out = '';
                        $out .= '
                        <!-- Event Wrapper -->
                        <div class="eventWrapper">
                            <!-- Guild Event -->
                            <div class="guildEvent noselect" style="border-color: '.$event['color'].';">
                                <input type="hidden" name="guildEventId" value="'.$event['id_event'].'">
                                <div class="guildEventName">'.$event['name'].'</div>
                                <div class="guildEventDesc">'.$event['shortDesc'].'</div>
                                <div class="guildEventMaxplayers">Max players: '.$event['max-users'].'</div>
                                <div class="guildEventDate">'.$event['date'].'</div>
                                <div class="guildEventStatus">Status: <span class="guildEventStatusCurrent">'. count($participants) .'</span>/'.$event['max-users'].'</div>
                            </div> <!-- / Guild Event -->
    
                            <!-- Modal -->
                            <div class="guildEventModal mqr noselect">
                                <input name="EventId" type="hidden" value="'.$event['id_event'].'">
                                <div class="guildEventModalContent">
                                    <div style="border-color: '.$event['color'].';" class="guildEventModalContent-Title mqr">'.$event['name'].'</div>
                                    ';
                                    if($userData[0]['guild_role'] == 'admin' || $userData[0]['guild_role'] == 'officer'){
                                        $out .= '<div class="eventModalDelete"><i class="fa-solid fa-trash-can fa-xl"></i></div>';
                                    }
                                    $out .= '
                                    <div class="guildEventModalClose"><i class="fas fa-times-circle fa-xl"></i></div>
                                <div class="ModalContentWrapper">
                                    <div class="guildEventModalContent-Description">
                                        <h3>Event Description</h3>
                                        <div class="descmodal">'.$event['description'].'</div>
                                    </div>
                                    <div class="guildEventModalContent-Participants">
                                        <h3>Participants: <span class="guildEventModal-Participants_counter"><span class="guildEventModalCurrentParticipants">'. count($participants) .'</span>/'.$event['max-users'].'</span></h3> 
                                        <ul class="guildEventCharacters">';
                                        foreach($participants as $user){
                                        if (isset($isInEvent)){
                                            if($isInEvent[0]['id_character'] == $user['id_character'] && $user['id_character']){
                                                $out .= '<li class="guildEventCharacter guildEventCharacterOwn"><div class="guildEventCharacterName">'.$user['name'].'</div><div class="guildEventCharacterDetails">'.$user['subclass']. ' ilvl ' .$user['ilvl'].'</div></li>';
                                            }else if($userData[0]['guild_role'] == 'admin' || $userData[0]['guild_role'] == 'officer'){
                                                $out .= '<li class="guildEventCharacter"><div class="guildEventKickUser"></div><input type="hidden" name="id_character" value="'.$user['id_character'].'"><div class="guildEventCharacterName">'.$user['name'].'</div><div class="guildEventCharacterDetails">'.$user['subclass']. ' ilvl ' .$user['ilvl'].'</div></li>';
                                            }else{
                                                $out .= '<li class="guildEventCharacter"><input type="hidden" name="id_character" value="'.$user['id_character'].'"><div class="guildEventCharacterName">'.$user['name'].'</div><div class="guildEventCharacterDetails">'.$user['subclass']. ' ilvl ' .$user['ilvl'].'</div></li>';
                                            }
                                        }else if($userData[0]['guild_role'] == 'admin' || $userData[0]['guild_role'] == 'officer'){
                                                $out .= '<li class="guildEventCharacter"><div class="guildEventKickUser"></div><input type="hidden" name="id_character" value="'.$user['id_character'].'"><div class="guildEventCharacterName">'.$user['name'].'</div><div class="guildEventCharacterDetails">'.$user['subclass']. ' ilvl ' .$user['ilvl'].'</div></li>';
                                            }else{
                                                $out .= '<li class="guildEventCharacter"><input type="hidden" name="id_character" value="'.$user['id_character'].'"><div class="guildEventCharacterName">'.$user['name'].'</div><div class="guildEventCharacterDetails">'.$user['subclass']. ' ilvl ' .$user['ilvl'].'</div></li>';
                                            }
                                        }
                                        $out .= '
                                        </ul>
                                    </div>
                                    <div class="guildEventModalContent-Button ';
                                    if($isInEvent != NULL){
                                        $out .= "guildEventModalContent-Button_Disabled";
                                    }
                                    $out.='">
                                        Join
                                    </div>
                                    <div class="guildEventModalContent-ButtonLeave ';
                                    if($isInEvent != NULL){
                                        $out .= "guildEventModalContent-ButtonLeave_Active";
                                    }
                                    $out .= '">
                                        Leave
                                    </div>
                                </div>
                                    </div>
                            </div> <!-- / Modal -->
    
                        </div> <!-- /Event Wrapper -->
                    ';
                    echo $out;
                    }
                    ?>

                    <!-- Character Picker Modal -->
                    <div class="characterPickerModal mqr noselect">
                        <div class="characterPickerModalContent">
                            <div class="guildEventModalContent-Title mqr">Character Select</div>
                            <div class="characterPickerModalClose"><i class="fas fa-times-circle fa-xl"></i></div>
                                <div class="ModalContentWrapper">
                                    <div class="characterPickerList">
                                        <?php
                                        $userCharacters = $main->getUserCharacters($userSession);
                                        foreach($userCharacters as $character){
                                            $characterClass = $main->getCharacterClass($character['id_class']);
                                            echo '<div class="characterPicker-Char"><input name="characterPicker-Ilvl" type="hidden" value="'.$character['ilvl'].'"> <input name="characterPicker-Char-Id" type="hidden" value="'.$character['id_character'].'"> <input type="hidden" name="characterPicker-ClassName" value="'.$characterClass[0]['subclass'].'"> <img src="./public/img/lostark/classes/'.$characterClass[0]['subclass'].'.png"><span class="characterPicker-CharName">'.$character['name'].'</span></div>';
                                        }
                                        ?>
                                    </div>
                                </div>                            
                        </div>
                    </div>

                    <!-- New Event Modal -->
                    <div class="newEventModal mqr noselect">
                        <div class="newEventModalContent">
                            <div class="newEventModalContent-Title mqr">New Event</div>
                            <div class="newEventModalClose"><i class="fas fa-times-circle fa-xl"></i></div>
                            <div class="ModalContentWrapper">
                            <form id="newEvent" class="newEvent">
                                <!-- Event Name -->
                                <label for="newEventName">Name</label>
                                <input type="text" name="newEventName" id="newEventName" maxlength="24" placeholder="Event Name">
                                <!-- Event Type -->
                                <label for="newEventType">Type</label>
                                <select name="newEventType" id="newEventType">
                                    <option value="Raid">Raid</option>
                                    <option value="GvG">GvG</option>
                                    <option value="PvP">Abyssal Dungeon</option>
                                    <option value="Legion Raid">Legion Raid</option>
                                    <option value="Abyssal Dungeon">Abyssal Dungeon</option>
                                    <option value="Others">Others</option>
                                </select>
                                <!-- Event ShortDesc -->
                                <label for="newEventShortDesc">Short Description (128 characters)</label>
                                <textarea name="newEventShortDesc" class="no-mqr" id="newEventShortDesc" maxlength="128" placeholder="Short Description (displayed on Event List)"></textarea>
                                <!-- Event LongDesc -->
                                <label for="newEventDesc">Long Description (512 characters)</label>
                                <textarea name="newEventDesc" class="no-mqr" id="newEventDesc" maxlength="512" placeholder="Long Description"></textarea>
                                <!-- Event DateTime -->
                                <label for="newEventDatetime">Event Date</label>
                                <input type="datetime-local" name="newEventDatetime" id="newEventDatetime">
                                <!-- Event Select MaxPlayers -->
                                <label for="newEventMaxPlayers">Max Players</label>
                                <input type="number" name="newEventMaxPlayers" id="newEventMaxPlayers" maxlength="3" min="1" max="100" pattern="[0-9]*" inputmode="numeric" placeholder="1-100">
                                <!-- Color -->
                                <label for="newEventColor">Accent Color</label>
                                <input type="color" name="newEventColor" id="newEventColor" list="newEventColors">
                                    <datalist id="newEventColors">
                                        <option>#914C63</option>
                                        <option>#D37466</option>
                                        <option>#EFF0FA</option>
                                        <option>#F9F871</option>
                                        <option>#482F4A</option>
                                    </datalist>
                                
                                <div class="newEventGenerateButton">Generate Event</div>
                            </form>
                            </div>
                        </div>                        
                    </div>


                    <?php
                    if($userData[0]['guild_role'] == 'admin' || $userData[0]['guild_role'] == 'officer'){
                    ?>
                    <!-- ADD BUTTON -->
                    <div class="addbtn noselect">
                        <a class="addbtn-fab addbtn-btn-large" id="addbtnBtn">+</a>
                        <ul class="addbtn-menu">
                            <li><a class="addbtn-fab addbtn-btn-sm addbtn-btn-raid scale-transition scale-out tooltip"><span class="tooltiptext">Raid</span></a></li>
                            <li><a class="addbtn-fab addbtn-btn-sm addbtn-btn-abyss scale-transition scale-out tooltip"><span class="tooltiptext">Abyss Dungeon</span></a></li>
                            <li><a class="addbtn-fab addbtn-btn-sm addbtn-btn-pvp scale-transition scale-out tooltip"><span class="tooltiptext">PvP</span></a></li>
                            <li><a class="addbtn-fab addbtn-btn-sm addbtn-btn-others scale-transition scale-out tooltip"><span class="tooltiptext">Others</span></a></li>
                        </ul>
                    </div><!-- END ADD BUTTON -->
                    <?php } ?>

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