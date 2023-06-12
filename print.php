<?php
include_once 'func.php'; 
include_once 'classes.php';

//echo "<pre>".print_r($_SESSION, true)."</pre>";

$user = getProfil();
//$user = $_SESSION["USER_PROFIL"];

//echo $user->toHTML();

$redirect = isGET('redirect');
$download = isGET('download');

?>
<DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/favicon.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/favicon.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <title>Arquivos - <?php echo $user->name; ?></title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</head>
<body>
    <div style="max-width: 680px;" id="print_content">
        <h3><?php echo $user->name; ?></h3>
        <hr/>
        <div id="print_files">
        <?php
            foreach ($user->files as $f) {
                echo $f->toHTML();
            }
        ?>
        </div>
    </div>
    
    <?php include 'snack_bar.php'; ?>

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
            //var html = document.documentElement.innerHTML;
            var html = document.getElementById('print_content').innerHTML;
            html = encodeURIComponent(html);
            printsubmit(html);
        });
    </script>
    <?php } ?>
    <?php if ($download) { ?>
    <script> 
        function base64ToArrayBuffer(data) {
            var binaryString = window.atob(data);
            var binaryLen = binaryString.length;
            var bytes = new Uint8Array(binaryLen);
            for (var i = 0; i < binaryLen; i++) {
                var ascii = binaryString.charCodeAt(i);
                bytes[i] = ascii;
            }
            return bytes;
        }
        function download(content) {
            // AJAX code to submit form.
            var params = window.location.search;
            params = new URLSearchParams(params);
            var toUrl = "send.php?download=1" + 
                (params.get('pdf') == '1'? "&pdf=1" : "");
                
        	$.ajax({
        		type: "POST",
        		url: toUrl,
        		data: 'formdata='+content, //formdata,
        		cache: false,
                /*xhrFields: {
                      responseType: 'blob'
                },*/
                success: function (data) {
                    //console.log(data);
                    //Convert the Byte Data to BLOB object.
                    var blob;
                    var fileName = 'Arquivos de <?php echo $user->name; ?>';
                    if (params.get('pdf') == '1') {
                        fileName += '.pdf';
                        //blob = new File([data], fileName, { type: 'application/force-download' });
                        blob = new Blob([data], { type: "application/pdf" });
                        //blob = b64toBlob(data, "application/pdf");
                    } else {
                        fileName += '.html';
                        blob = new Blob([data], { type: "application/octetstream" });
                    }
 
                    //Check the Browser type and download the File.
                    var isIE = false || !!document.documentMode;
                    if (isIE) {
                        window.navigator.msSaveBlob(blob, fileName);
                    } else {
                        var url = window.URL || window.webkitURL;
                        link = url.createObjectURL(blob);
                        var a = $("<a />");
                        a.attr("download", fileName);
                        a.attr("href", link);
                        $("body").append(a);
                        a[0].click();
                        a.remove();
                    }
                }
            });
        }
        function b64toBlob(content, contentType) {
            contentType = contentType || '';
            const sliceSize = 512;
             // method which converts base64 to binary
            const byteCharacters = window.atob(content); 
        
            const byteArrays = [];
            for (let offset = 0; offset < byteCharacters.length; offset += sliceSize) {
                const slice = byteCharacters.slice(offset, offset + sliceSize);
                const byteNumbers = new Array(slice.length);
                for (let i = 0; i < slice.length; i++) {
                    byteNumbers[i] = slice.charCodeAt(i);
                }
                const byteArray = new Uint8Array(byteNumbers);
                byteArrays.push(byteArray);
            }
            const blob = new Blob(byteArrays, {
                type: contentType
            }); // statement which creates the blob
            return blob;
        };
        
        $( window ).on( "load", function() {
            //var html = new XMLSerializer().serializeToString(document);
            //var html = document.documentElement.innerHTML;
            var html = document.getElementById('print_content').innerHTML;
            html = encodeURIComponent(html);
            message('Preparando download de ' + html.length + ' Bytes de dados.');
            download(html);
        });
    </script>
    <?php } ?>
    
    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</body>
</html>