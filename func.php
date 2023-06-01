<?php
// Start the session
session_start();

include_once 'classes.php';

function add_file($f) {
    $user = new Person();
    if (isset($_SESSION["USER_PROFIL"])) {
        $user = $_SESSION["USER_PROFIL"];
    }
    
    $user->add($f);

    $_SESSION["USER_PROFIL"] = $user;
} 

function update_form($student_name, $student_mail, $prof_mail) {
    $user = new Person();
    if (isset($_SESSION["USER_PROFIL"])) {
        $user = $_SESSION["USER_PROFIL"];
    }
    
    $user->name = $student_name;
    $user->mail = $student_mail;

    $_SESSION["USER_PROFIL"] = $user;
    $_SESSION["MAIL_TO"] = $prof_mail;
}
?>