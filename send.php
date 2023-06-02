<?php
include_once 'func.php'; 

if (isset($_GET['send']) && $_GET['send'] == 1) {
    echo print_r($_POST, true); die();
} else {
    $student_name = $_POST['student_name'];
    $student_mail = $_POST['student_mail'];
    $prof_mail = $_POST['prof_mail'];

    update_form($student_name, $student_mail, $prof_mail);

    header("Location: print.php?redirect=1");
    die();
}
//session_destroy();
//echo "Feito! Confira se o e-mail foi recebido."; //die;
?>    