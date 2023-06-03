<?php
include_once 'func.php'; 
include_once 'classes.php';

//echo "<pre>".print_r($_SESSION, true)."</pre>";

$user = getProfil();
//$user = $_SESSION["USER_PROFIL"];

//echo $user->toHTML();

$redirect = false;
if (isset($_GET['redirect']) && $_GET['redirect'] == 1) {
    $redirect = true;
}

$download = false;
if (isset($_GET['download']) && $_GET['download'] == 1) {
    $download = true;
}

?>
<DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>Arquivos - <?php echo $user->name; ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body style="max-width: 680px;">
    <h3><?php echo $user->name; ?></h3>
    <hr/>
    <div id="print_files">
    <?php
        foreach ($user->files as $f) {
            echo $f->toHTML();
        }
    ?>
    </div>

    <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
    <?php if ($redirect) { ?>
    <script>  
        function printsubmit(content) {
            // AJAX code to submit form.
        	$.ajax({
        		 type: "POST",
        		 url: "send.php?send=1",
        		 data: 'formdata='+content, //formdata,
        		 cache: false,
        		 success: function(html) {
        		    alert(html);
        		 }
        	});
        
        	return false;
        }
        
        $( window ).on( "load", function() {
            //var html = new XMLSerializer().serializeToString(document);
            var html = document.documentElement.innerHTML;
            printsubmit(html);
        });
    </script>
    <?php } ?>
    <?php if ($download) { ?>
    <script> 
        function download(content) {
            // AJAX code to submit form.
        	$.ajax({
        		 type: "POST",
        		 url: "send.php?download=1",
        		 data: 'formdata='+content, //formdata,
        		 cache: false,
        		 success: function(html) {
        		    //alert(html);
        		    //Convert the Byte Data to BLOB object.
                    var blob = new Blob([html], { type: "applicatio/octetstream" });
                    //Check the Browser type and download the File.
                    var isIE = false || !!document.documentMode;
                    if (isIE) {
                        window.navigator.msSaveBlob(blob, fileName);
                    } else {
                        var url = window.URL || window.webkitURL;
                        link = url.createObjectURL(blob);
                        var a = $("<a />");
                        a.attr("download", 'Arquivos de <?php echo $user->name; ?>.pdf');
                        a.attr("href", link);
                        $("body").append(a);
                        a[0].click();
                        $("body").remove(a);
                    }
        		 }
        	});
        
        	return false;
        }
        
        $( window ).on( "load", function() {
            //var html = new XMLSerializer().serializeToString(document);
            var html = document.documentElement.innerHTML;
            download(html);
        });
    </script>
    <?php } ?>
</body>
</html>