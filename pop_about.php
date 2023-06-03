<dialog class="mdl-dialog" id="dialog-about">
    <h4 class="mdl-dialog__title">Sobre</h4>
    <div class="mdl-dialog__content">
    <p>
        Criado por Tarlis Portela.
    </p>
    </div>
    <div class="mdl-dialog__actions">
    <button type="button" class="mdl-button close" id="close-about">Fechar</button>
    </div>
</dialog>
<script>
    var dialog = document.querySelector('#dialog-about');
    var showDialogButton = document.querySelector('#show-about');
    if (!dialog.showModal) {
    dialogPolyfill.registerDialog(dialog);
    }
    showDialogButton.addEventListener('click', function() {
    dialog.showModal();
    });
    dialog.querySelector('#close-about').addEventListener('click', function() {
    dialog.close();
    });
</script>