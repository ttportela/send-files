<?php
// Start the session
session_start();

// BASIC CONFIG:
$FROM = "Arquivos Tarlis <tarlis@tarlis.com.br>";

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

function mailsend() {
    $user = getProfil();
    $to = $_SESSION["MAIL_TO"];
    $subject = "Arquivos de ".$user->name;

    $content = $user->toHTML();

    $message = $content;//"Seguem os arquivos de ".$user->name;
    $headers = "From: ".$FROM."\r\n" .
        'Reply-To: '.$user->name.' <'.$user->mail . ">\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=UTF-8' . "\r\n";// .
//		    'X-Mailer: PHP/' . phpversion();
    
    try{
        @mail($to, $subject, $message, $headers);
        // 'Obrigado por entrar em contato =D';
        return true;
    } catch (Exception $e) {
        // 'Sua mensagem não pode ser enviada, tente novamente mais tarde.';
        //$this->trace($e);
        return false;
    }
}
?>