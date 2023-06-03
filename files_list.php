<?php include_once 'func.php'; ?>
<div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
    <h6>Lista de arquivos:</h6>
    <ul class="files-list files-list-item mdl-list">
    <?php 
    $user = getProfil();
    if ($user->hasFiles()) { 
        foreach ($user->files as $f) {
            echo $f->toLiHTML();
        }
    } ?>
    </ul>
</div>