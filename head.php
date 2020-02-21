<?php

$USER = $_COOKIE['user'];

require "api.php";


function isAdmin($login) {
    global $SETTINGS;
    $user = getUserByLogin($login);
    if($user && $user['group_id'] == $SETTINGS['GROUPS']['ADMIN']) {
        return true;
    }
    return false;
}

function isDriver($login) {
    global $SETTINGS;
    $user = getUserByLogin($login);
    if($user && $user['group_id'] == $SETTINGS['GROUPS']['DRIVER']) {
        return true;
    }
    return false;
}
?>