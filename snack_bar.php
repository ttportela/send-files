<div id="print-snackbar" class="mdl-js-snackbar mdl-snackbar">
    <div class="mdl-snackbar__text"></div>
    <button class="mdl-snackbar__action" type="button"></button>
</div>
<script>
    function message(msg) {
    var notification = document.querySelector('#print-snackbar');
    var data = {message: msg};
    setTimeout(function () { notification.MaterialSnackbar.showSnackbar(data);}, 0.5);
    }
</script>