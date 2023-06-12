<?php
// Start the session
session_start();

// BASIC CONFIG:
$FROM = "Arquivos Tarlis <arquivos@tarlis.com.br>";
$TO_MAIL = 'tarlis.portela@ifpr.edu.br';

include_once 'classes.php';

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

function hasPOST($key) {
    return array_key_exists($key, $_POST) &&
            isset($_POST[$key]) && "" != trim($_POST[$key]);
}

function isGET($key) {
    return array_key_exists($key, $_GET) &&
            isset($_GET[$key]) && ($_GET[$key] == 1);
}

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

function clear() {
    $user = getProfil();
    
    $user->files = array();

    setProfil($user);
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

function getMailTo() {
    if (array_key_exists("MAIL_TO", $_SESSION) && isset($_SESSION["MAIL_TO"])) {
        return $_SESSION["MAIL_TO"];
    } else {
        global $TO_MAIL;
        $_SESSION["MAIL_TO"] = $TO_MAIL;
        return $TO_MAIL;
    }
}

function prepareContent($content) {
    $origin = array('class="kwd"', 'class="pln"', 'class="pun"', 'class="typ"', 'class="str"', 'class="lit"'); // , ''
    $destin = array('style="color: #008;"', 'style="color: #000;"', 'style="color: #660;"', 'style="color: #606;"', 'style="color: #080;"', 'style="color: #066;"'); // , 'style=""'
    
    for ($i = 0; $i < count($origin); $i++) {
         $content = str_replace($origin[$i], $destin[$i], $content);
    }
    return $content;
}

function content2pdf($content) {
    $user = getProfil();
    //$content = $user->toHTML();
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml(prepareContent($content), 'UTF-8');
//    $dompdf->loadHtml('<DOCTYPE html><html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'.$content.'</html>');
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->add_info('Title', "Arquivos");
    $dompdf->add_info('Author', $user->name);
    $dompdf->render();
    // Output the generated PDF
    //$dompdf->stream("Teste.pdf", array("Attachment" => 0)); die();
    //file_put_contents('filename.pdf', $dompdf->output());
    //file_put_contents('filename.html', $content);
    //echo 'DEU'; die();
    return $dompdf;
}

function content2html($content) {
    return prepareContent($content);
}

function mailsend_att($content) {
    global $FROM;
    $user = getProfil();
    $to = $_SESSION["MAIL_TO"];
    $subject = "Arquivos de ".$user->name;
    
    $cc = null;
    if ($user->mail != null && isset($user->mail) && $user->mail != '')
        $cc = $user->name." <".$user->mail.">";

    //$content = $user->toHTML();
    //$content = content2pdf($content)->output();
    $content = prepareContent($content);
    
    // Attachment file 
    $file = $subject.".html"; 
 
    // Email body content 
    $fileList = '<ol>';
    foreach ($user->files as $f) {
        $fileList .= '<li>'.$f->name . ' ('.$f->size.'B)</li>';
    }
    $fileList .= '</ol>';
    $htmlContent = $subject . ' ('.count($user->files).')<br/>'.$fileList; 
 
    // Header for sender info 
    $headers = "From: ".$FROM."";
    //$headers .= "\nReply-To: ".$FROM."";
    //$headers .= (($cc != null)? "\nCc: ".$cc."" : ""); 
    
    $to .= (($cc != null)? ",".$cc."" : ""); 
 
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
    // Preparing attachment 
    $message .= "--{$mime_boundary}\n";
    $data = chunk_split(base64_encode($content)); 
    $message .= "Content-Type: application/octet-stream; name=\"".$file."\"\n" .  
    "Content-Description: ".$file."\n" . 
    "Content-Disposition: attachment;\n" . " filename=\"".$file."\";\n" .  
    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
        
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $FROM; 
    
    try{
        // 'Obrigado por entrar em contato =D';
        return @mail($to, $subject, $message, $headers, $returnpath);
    } catch (Exception $e) {
        // 'Sua mensagem n達o pode ser enviada, tente novamente mais tarde.';
        //$this->trace($e);
        return false;
    }
}

function mailsend_att_pdf($content) {
    global $FROM;
    $user = getProfil();
    $to = $_SESSION["MAIL_TO"];
    $subject = "Arquivos de ".$user->name;
    
    $cc = null;
    if ($user->mail != null && isset($user->mail) && $user->mail != '')
        $cc = $user->name." <".$user->mail.">";

    //$content = $user->toHTML();
    $content = content2pdf($content)->output(); // TODO pre identation to pdf
    //$content = prepareContent($content);
    
    // Attachment file 
    $file = $subject.".pdf"; 
 
    // Email body content 
    $htmlContent = $subject; 
 
    // Header for sender info 
    $headers = "From: ".$FROM."";
    //$headers .= "\nReply-To: ".$FROM."";
    $headers .= (($cc != null)? "\nCc: ".$cc."" : ""); 
    
    //$to .= (($cc != null)? ",".$cc."" : ""); 
 
    // Boundary  
    $semi_rand = md5(time());  
    $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";  
 
    // Headers for attachment  
    $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 
 
    // Multipart boundary  
    $message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" . 
    "Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n";  
 
    // Preparing attachment // octet-stream
    $message .= "--{$mime_boundary}\n";
    $data = chunk_split(base64_encode($content)); 
    $message .= "Content-Type: application/pdf; name=\"".$file."\"\n" .  
    "Content-Description: ".$file."\n" . 
    "Content-Disposition: attachment;\n" . " filename=\"".$file."\";\n" .  
    "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n"; 
        
    $message .= "--{$mime_boundary}--"; 
    $returnpath = "-f" . $FROM; 
    
    try{
        // 'Obrigado por entrar em contato =D';
        return @mail($to, $subject, $message, $headers, $returnpath);
    } catch (Exception $e) {
        // 'Sua mensagem n達o pode ser enviada, tente novamente mais tarde.';
        //$this->trace($e);
        return false;
    }
}

function mailsend($content) {
    global $FROM;
    $user = getProfil();
    $to = $_SESSION["MAIL_TO"];
    $subject = "Arquivos de ".$user->name;

    //$content = $user->toHTML();
    //$content = content2pdf($content)->output();
    
    $body = $subject .'<br/><br/>'. prepareContent($content);
    $headers = "From: ".$FROM."\r\n" .
        'Reply-To: '.$user->name.' <'.$user->mail . ">\r\n" .
        'Cc: '.$user->name.' <'.$user->mail . ">\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-Type: text/html; charset=UTF-8' . "\r\n";// .
    
    //echo print_r(array($to, $headers, $body)); die();
    
    try{
        @mail($to, $subject, $body, $headers);
        // 'Obrigado por entrar em contato =D';
        return true;
    } catch (Exception $e) {
        // 'Sua mensagem não pode ser enviada, tente novamente mais tarde.';
        //$this->trace($e);
        return false;
    }
}
?>