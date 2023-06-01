<?php

include_once 'func.php'; 

$student_name = $_POST['student_name'];
$student_mail = $_POST['student_mail'];
$prof_mail = $_POST['prof_mail'];

update_form($student_name, $student_mail, $prof_mail);
echo "All done!"; die;
?>    