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
    
    //echo strlen(content2pdf($_POST['formdata'])->output()); die();
    if (isGET('pdf')) {
        //file_put_contents('teste.pdf', content2pdf($_POST['formdata'])->output());
        echo content2pdf($_POST['formdata'])->output();
        /*$out = content2pdf($_POST['formdata'])->output();
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"Arquivos.pdf\"");
        header("Content-Length: " . filesize($out));
        echo $out; */
        //content2pdf($_POST['formdata'])->stream();
    } else {
        echo content2html($_POST['formdata']); die();
    }
    
} else {
    $student_name = $_POST['student_name'];
    $student_mail = $_POST['student_mail'];
    $prof_mail = $_POST['prof_mail'];

    update_form($student_name, $student_mail, $prof_mail);

    //echo "Feito! Confira se o e-mail foi recebido."; //die;
}
//session_destroy();
?>