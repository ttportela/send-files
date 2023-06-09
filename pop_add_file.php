<dialog class="mdl-dialog" id="dialog-add_file" style="width: 50%;">
    <form id="file-add_data" action="#" method="POST">
    <h4 class="mdl-dialog__title">Adicionar Arquivo Manualmente</h4>
    <div class="mdl-dialog__content">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="file_name"/>
                    <label class="mdl-textfield__label" for="file_name">NomeDoArquivo.ext</label>
                    <span class="mdl-textfield__error">Por favor informe o nome do arquivo com extensão.</span>
                </div>
            </div>
            <div class="mdl-cell mdl-cell--12-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label" style="width: 100%;">
                    <textarea class="mdl-textfield__input" type="text" rows="10" id="file_content"></textarea>
                    <label class="mdl-textfield__label" for="file_content">Conteúto do Arquivo</label>
                    <span class="mdl-textfield__error">Por favor cole o conteúdo do arquivo.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="mdl-dialog__actions">
    <button type="button" class="mdl-button" id="submit-add_file">Enviar</button>
    <button type="button" class="mdl-button close" id="close-add_file">Fechar</button>
    </div>
    </form>
</dialog>
<script>
    var dialog_add_file = document.querySelector('#dialog-add_file');
    var showDialog_add_file = document.querySelector('#show-add_file');
    if (!dialog_add_file.showModal) {
        dialogPolyfill.registerDialog(dialog_add_file);
    }
    showDialog_add_file.addEventListener('click', function() {
        dialog_add_file.showModal();
    });
    dialog_add_file.querySelector('#close-add_file').addEventListener('click', function() {
        dialog_add_file.close();
        document.getElementById("file-add_data").reset();
    });
    dialog_add_file.querySelector('#submit-add_file').addEventListener('click', function() {
        fileaddsubmit();
    });

    function fileaddsubmit() {
        var file_name = document.getElementById('file_name').value;
        var file_content = document.getElementById('file_content').value;
        
        //store all the submitted data in astring.
        var formdata = 'file_name=' + file_name + '&file_content=' + file_content;
        
        // AJAX code to submit form.
        $.ajax({
            type: "POST",
            url: "ajax_add_file.php",
            data: formdata,
            cache: false,
            success: function(msg) {
                var oOutput = document.querySelector('.files-list');
                oOutput.innerHTML += ""+ msg +"";
                //alert(msg);
                dialog_add_file.close();
                document.getElementById("file-add_data").reset();
            },
            error: function(msg) {
                var oOutput = document.querySelector('.files-list');
                dialog_add_file.close();
                oOutput.innerHTML += msg;
            }
        });

        return false;
    }
</script>