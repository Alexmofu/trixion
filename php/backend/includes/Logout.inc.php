<?php

/* COOKIE REMOVAL */
if (isset($_COOKIE['remember'])) {
    unset($_COOKIE['remember']); 
    setcookie('remember', FALSE, -1, '/', 'www.trixion.net');

}

/* SESSION REMOVAL */
session_start();
session_unset();
session_destroy();


//Back to the frontpage
header('Location: https://www.trixion.net/account');

?>