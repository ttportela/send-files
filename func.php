<?php
// Start the session
session_start();

include_once 'classes.php';

function add_file($f) {
    if (isset($_SESSION["USER_PROFIL"])) {
        $user = $_SESSION["USER_PROFIL"];
    } else {
        $user = new Person();
    }
    
    $user->add($f);

    $_SESSION["USER_PROFIL"] = $user;
} 

function update_form($student_name, $student_mail, $prof_mail) {
    if (isset($_SESSION["USER_PROFIL"])) {
        $user = $_SESSION["USER_PROFIL"];
    } else {
        $user = new Person();
    }
    
    $user->name = $student_name;
    $user->mail = $student_mail;

    $_SESSION["USER_PROFIL"] = $user;
    $_SESSION["MAIL_TO"] = $prof_mail;
}
?>