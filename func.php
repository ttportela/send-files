<?php
// Start the session
session_start();

include_once 'classes.php';

function getProfil() {
    $user = new Person();
    if (isset($_SESSION["USER_PROFIL"])) {
        $user = unserialize($_SESSION["USER_PROFIL"]);
    }
    return $user;
}

function setProfil($user) {
    $_SESSION["USER_PROFIL"] = serialize($user);
}

function add_file($f) {
    $user = getProfil();
    
    $user->add($f);

    setProfil($user);
} 

function update_form($student_name, $student_mail, $prof_mail) {
    $user = getProfil();
    
    $user->name = $student_name;
    $user->mail = $student_mail;

    setProfil($user);
    $_SESSION["MAIL_TO"] = $prof_mail;
}
?>