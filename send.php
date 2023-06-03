<?php
include_once 'func.php'; 

if (isGET('send')) {
    //echo print_r($_POST, true); die();
    if (mailsend_att($_POST['formdata']))
        echo "Feito! Confira se o e-mail foi recebido."; //die;
    else
        //echo error_get_last()['message'];
        echo "Ocorreu algum problema, contate o professor.";
} else if (isGET('download')) {
    
    //echo print_r($_POST['formdata'], true); die();
    echo content2pdf($_POST['formdata'])->output(); die();
    
} else {
    $student_name = $_POST['student_name'];
    $student_mail = $_POST['student_mail'];
    $prof_mail = $_POST['prof_mail'];

    update_form($student_name, $student_mail, $prof_mail);

    //echo "Feito! Confira se o e-mail foi recebido."; //die;
}
//session_destroy();
?>