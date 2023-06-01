<?php
include_once 'func.php'; 
include_once 'classes.php';

echo "<pre>".print_r($_SESSION, true)."</pre>";

$user = getProfil();
//$user = $_SESSION["USER_PROFIL"];
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<title>Arquivos - <?php echo $user->name; ?></title>

</head>
<body>
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

</body>
</html>